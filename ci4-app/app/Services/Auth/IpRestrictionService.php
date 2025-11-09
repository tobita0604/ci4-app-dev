<?php

namespace App\Services\Auth;

use App\Models\AdminIpModel;

/**
 * IP制限サービス
 * 
 * 管理画面へのIPアドレスベースのアクセス制御を行うサービス
 * 
 * @package App\Services\Auth
 */
class IpRestrictionService
{
    /**
     * 管理者IPモデル
     * 
     * @var AdminIpModel
     */
    protected AdminIpModel $adminIpModel;

    /**
     * IP制限有効フラグ
     * 
     * @var bool
     */
    protected bool $enabled;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->adminIpModel = new AdminIpModel();
        
        // 環境変数からIP制限有効/無効を取得（デフォルトは有効）
        $this->enabled = env('IP_RESTRICTION_ENABLED', true);
    }

    /**
     * IPアドレスがアクセス許可されているかチェック
     * 
     * @param string|null $ipAddress チェックするIPアドレス（nullの場合は現在のIPを使用）
     * @return bool アクセス許可されているか
     */
    public function isAllowed(?string $ipAddress = null): bool
    {
        // IP制限が無効の場合は常に許可
        if (!$this->enabled) {
            return true;
        }

        // IPアドレスが指定されていない場合は現在のIPを取得
        if ($ipAddress === null) {
            $ipAddress = $this->getCurrentIp();
        }

        // ローカル環境は常に許可
        if ($this->isLocalEnvironment($ipAddress)) {
            return true;
        }

        // データベースに登録されたIPアドレスと照合
        return $this->adminIpModel->isAllowedByRanges($ipAddress);
    }

    /**
     * 現在のクライアントIPアドレスを取得
     * 
     * @return string IPアドレス
     */
    public function getCurrentIp(): string
    {
        $request = service('request');
        
        // プロキシ経由の場合の対応
        if ($request->hasHeader('X-Forwarded-For')) {
            $ips = explode(',', $request->getHeaderLine('X-Forwarded-For'));
            return trim($ips[0]);
        }

        if ($request->hasHeader('X-Real-IP')) {
            return $request->getHeaderLine('X-Real-IP');
        }

        return $request->getIPAddress();
    }

    /**
     * ローカル環境かどうかチェック
     * 
     * @param string $ipAddress IPアドレス
     * @return bool ローカル環境か
     */
    public function isLocalEnvironment(string $ipAddress): bool
    {
        $localIps = [
            '127.0.0.1',
            '::1',
            'localhost'
        ];

        // 完全一致チェック
        if (in_array($ipAddress, $localIps, true)) {
            return true;
        }

        // プライベートIPアドレス範囲チェック
        return $this->isPrivateIp($ipAddress);
    }

    /**
     * プライベートIPアドレスかどうかチェック
     * 
     * @param string $ipAddress IPアドレス
     * @return bool プライベートIPか
     */
    public function isPrivateIp(string $ipAddress): bool
    {
        $privateRanges = [
            '10.0.0.0/8',
            '172.16.0.0/12',
            '192.168.0.0/16'
        ];

        foreach ($privateRanges as $range) {
            if ($this->adminIpModel->isInRange($ipAddress, $range)) {
                return true;
            }
        }

        return false;
    }

    /**
     * IP制限の有効/無効を設定
     * 
     * @param bool $enabled 有効にするか
     * @return void
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * IP制限が有効かどうか取得
     * 
     * @return bool 有効か
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * IPアドレスを登録
     * 
     * @param string $addressName アドレス名称
     * @param string $ipAddress IPアドレス
     * @return bool 登録成功フラグ
     */
    public function registerIp(string $addressName, string $ipAddress): bool
    {
        $data = [
            'address_name' => $addressName,
            'ip_address' => $ipAddress,
            'display_flg' => 0
        ];

        return (bool) $this->adminIpModel->insert($data);
    }

    /**
     * IPアドレスを削除（論理削除）
     * 
     * @param int $id IP設定ID
     * @return bool 削除成功フラグ
     */
    public function deleteIp(int $id): bool
    {
        return $this->adminIpModel->delete($id);
    }

    /**
     * IPアドレスを有効化/無効化
     * 
     * @param int $id IP設定ID
     * @param bool $enable 有効化するか
     * @return bool 更新成功フラグ
     */
    public function toggleIpStatus(int $id, bool $enable): bool
    {
        return $this->adminIpModel->toggleStatus($id, $enable);
    }

    /**
     * 有効なIPアドレス一覧を取得
     * 
     * @return array IPアドレス一覧
     */
    public function getActiveIps(): array
    {
        return $this->adminIpModel->getActiveIps();
    }

    /**
     * すべてのIPアドレス一覧を取得（無効なものも含む）
     * 
     * @return array IPアドレス一覧
     */
    public function getAllIps(): array
    {
        return $this->adminIpModel->findAll();
    }

    /**
     * アクセス拒否時のエラーログを記録
     * 
     * @param string $ipAddress 拒否されたIPアドレス
     * @param string $path アクセスしようとしたパス
     * @return void
     */
    public function logAccessDenied(string $ipAddress, string $path): void
    {
        log_message('warning', "IP制限: アクセス拒否 IP={$ipAddress}, Path={$path}");
    }
}
