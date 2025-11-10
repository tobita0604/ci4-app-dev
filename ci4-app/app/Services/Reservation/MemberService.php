<?php

namespace App\Services\Reservation;

use App\Models\Reserver\MemberModel;

/**
 * 会員関連サービス
 * 
 * 会員情報の取得、登録、更新などのビジネスロジックを提供します。
 */
class MemberService
{
    /**
     * @var MemberModel 会員モデル
     */
    protected MemberModel $memberModel;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->memberModel = new MemberModel();
    }

    /**
     * 会員一覧を取得
     * 
     * @param array $filters フィルタ条件
     * @param int $page ページ番号
     * @param int $perPage 1ページあたりの件数
     * @return array
     */
    public function getMembers(array $filters = [], int $page = 1, int $perPage = 20): array
    {
        // TODO: フィルタ条件に基づいた会員検索実装
        return [
            'data' => [],
            'total' => 0,
            'page' => $page,
            'perPage' => $perPage,
        ];
    }

    /**
     * 会員情報を取得
     * 
     * @param int $memberId 会員ID
     * @return array|null
     */
    public function getMemberById(int $memberId): ?array
    {
        return $this->memberModel->find($memberId);
    }

    /**
     * メールアドレスで会員を検索
     * 
     * @param string $email メールアドレス
     * @return array|null
     */
    public function getMemberByEmail(string $email): ?array
    {
        return $this->memberModel->where('R01_Email', $email)->first();
    }

    /**
     * 会員を登録
     * 
     * @param array $data 会員データ
     * @return int|bool 登録されたID、または失敗時false
     */
    public function createMember(array $data)
    {
        // パスワードのハッシュ化
        if (isset($data['password'])) {
            $data['R01_Password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password']);
        }

        return $this->memberModel->insert($data);
    }

    /**
     * 会員情報を更新
     * 
     * @param int $memberId 会員ID
     * @param array $data 更新データ
     * @return bool
     */
    public function updateMember(int $memberId, array $data): bool
    {
        // パスワードが含まれる場合はハッシュ化
        if (isset($data['password'])) {
            $data['R01_Password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password']);
        }

        return $this->memberModel->update($memberId, $data);
    }

    /**
     * 会員を削除
     * 
     * @param int $memberId 会員ID
     * @return bool
     */
    public function deleteMember(int $memberId): bool
    {
        return $this->memberModel->delete($memberId);
    }

    /**
     * 会員認証
     * 
     * @param string $email メールアドレス
     * @param string $password パスワード
     * @return array|null 認証成功時は会員情報、失敗時はnull
     */
    public function authenticate(string $email, string $password): ?array
    {
        $member = $this->getMemberByEmail($email);

        if (!$member) {
            return null;
        }

        // パスワード検証
        if (password_verify($password, $member['R01_Password'])) {
            // パスワード情報を除外して返す
            unset($member['R01_Password']);
            return $member;
        }

        return null;
    }

    /**
     * 会員統計情報を取得
     * 
     * @return array
     */
    public function getMemberStatistics(): array
    {
        // TODO: 会員統計情報の実装
        return [
            'total' => 0,
            'active' => 0,
            'new_this_month' => 0,
        ];
    }
}
