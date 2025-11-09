<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * 管理者IP制限モデル
 * 
 * 管理画面へのアクセスを許可するIPアドレスを管理
 * 
 * @package App\Models
 */
class AdminIpModel extends Model
{
    /**
     * テーブル名
     * 
     * @var string
     */
    protected $table = 'admin_ips';

    /**
     * 主キー
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * 自動インクリメント使用フラグ
     * 
     * @var bool
     */
    protected $useAutoIncrement = true;

    /**
     * 戻り値の型
     * 
     * @var string
     */
    protected $returnType = 'array';

    /**
     * ソフトデリート使用フラグ
     * 
     * @var bool
     */
    protected $useSoftDeletes = true;

    /**
     * 削除日時フィールド名
     * 
     * @var string
     */
    protected $deletedField = 'deleted_at';

    /**
     * 許可されたフィールド
     * 
     * @var array
     */
    protected $allowedFields = [
        'address_name',
        'ip_address',
        'display_flg'
    ];

    /**
     * 作成日時フィールド名
     * 
     * @var string
     */
    protected $createdField = 'created_at';

    /**
     * 更新日時フィールド名
     * 
     * @var string
     */
    protected $updatedField = 'updated_at';

    /**
     * タイムスタンプ使用フラグ
     * 
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * バリデーションルール
     * 
     * @var array
     */
    protected $validationRules = [
        'address_name' => 'required|max_length[50]',
        'ip_address' => 'required|valid_ip|max_length[45]|is_unique[admin_ips.ip_address,id,{id}]',
        'display_flg' => 'in_list[0,1]'
    ];

    /**
     * バリデーションメッセージ
     * 
     * @var array
     */
    protected $validationMessages = [
        'address_name' => [
            'required' => 'アドレス名称は必須です'
        ],
        'ip_address' => [
            'required' => 'IPアドレスは必須です',
            'valid_ip' => 'IPアドレスの形式が不正です',
            'is_unique' => 'このIPアドレスは既に登録されています'
        ]
    ];

    /**
     * 有効なIPアドレス一覧を取得
     * 
     * @return array IPアドレス一覧
     */
    public function getActiveIps(): array
    {
        return $this->where('display_flg', 0)->findAll();
    }

    /**
     * IPアドレスがアクセス許可されているかチェック
     * 
     * @param string $ipAddress チェックするIPアドレス
     * @return bool アクセス許可されているか
     */
    public function isAllowed(string $ipAddress): bool
    {
        $result = $this->where('ip_address', $ipAddress)
                      ->where('display_flg', 0)
                      ->first();

        return $result !== null;
    }

    /**
     * IPアドレス範囲のチェック（CIDR表記対応）
     * 
     * @param string $ipAddress チェックするIPアドレス
     * @param string $range CIDR表記の範囲（例: 192.168.1.0/24）
     * @return bool 範囲内か
     */
    public function isInRange(string $ipAddress, string $range): bool
    {
        // CIDR表記のパース
        if (strpos($range, '/') === false) {
            // 単一IPアドレスの場合
            return $ipAddress === $range;
        }

        list($subnet, $mask) = explode('/', $range);
        
        $ipLong = ip2long($ipAddress);
        $subnetLong = ip2long($subnet);
        $maskLong = -1 << (32 - (int)$mask);
        
        return ($ipLong & $maskLong) === ($subnetLong & $maskLong);
    }

    /**
     * 複数のIP範囲からチェック
     * 
     * @param string $ipAddress チェックするIPアドレス
     * @return bool いずれかの範囲に含まれるか
     */
    public function isAllowedByRanges(string $ipAddress): bool
    {
        $ips = $this->getActiveIps();

        foreach ($ips as $ip) {
            if ($this->isInRange($ipAddress, $ip['ip_address'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * IPアドレスを有効化/無効化
     * 
     * @param int $id IP設定ID
     * @param bool $enable 有効化するか（true=有効, false=無効）
     * @return bool 更新成功フラグ
     */
    public function toggleStatus(int $id, bool $enable): bool
    {
        return $this->update($id, ['display_flg' => $enable ? 0 : 1]);
    }
}
