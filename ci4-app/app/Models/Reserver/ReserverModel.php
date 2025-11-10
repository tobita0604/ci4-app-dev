<?php

namespace App\Models\Reserver;

use CodeIgniter\Model;

/**
 * 予約者モデル
 * 
 * 旅行予約者の基本情報、ログイン情報、招待枠管理を行うモデル
 * 
 * @package App\Models\Reserver
 */
class ReserverModel extends Model
{
    /**
     * テーブル名
     * 
     * @var string
     */
    protected $table = 'reservers';

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
    protected $useAutoIncrement = false;

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
    protected $useSoftDeletes = false;

    /**
     * 許可されたフィールド
     * 
     * @var array
     */
    protected $allowedFields = [
        'id',
        'password',
        'code',
        'category_flg',
        'q1_flg',
        'q4_flg',
        'park_flg',
        'free_invites',
        'charge_invites',
        'branch_code',
        'branch_name',
        'branch_sort',
        'brochure_img',
        'note',
        'login_flg',
        'first_login_date',
        'last_login_date',
        'update_date',
        'update_user',
        'invoice_flg',
        'dinner_hotel_flg',
        'car_rental',
        'q4',
        'go_flight',
        'go_ticket',
        'all_cancel',
        'test_flg',
        'reentry'
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
        'id' => 'required|max_length[15]|is_unique[reservers.id,id,{id}]',
        'password' => 'required|min_length[8]',
        'code' => 'required|max_length[10]',
        'branch_code' => 'required|max_length[10]',
        'branch_name' => 'required|max_length[100]'
    ];

    /**
     * バリデーションメッセージ
     * 
     * @var array
     */
    protected $validationMessages = [
        'id' => [
            'required' => '予約者IDは必須です',
            'is_unique' => 'この予約者IDは既に使用されています'
        ],
        'password' => [
            'required' => 'パスワードは必須です',
            'min_length' => 'パスワードは8文字以上で入力してください'
        ]
    ];

    /**
     * 予約者認証
     * 
     * @param string $reserverId 予約者ID
     * @param string $password パスワード（平文）
     * @return array|null 予約者情報 or null
     */
    public function authenticate(string $reserverId, string $password): ?array
    {
        $reserver = $this->where('id', $reserverId)->first();
        
        if (!$reserver) {
            return null;
        }

        // パスワード検証
        if (password_verify($password, $reserver['password'])) {
            return $reserver;
        }

        return null;
    }

    /**
     * ログイン日時を更新
     * 
     * @param string $reserverId 予約者ID
     * @param bool $isFirstLogin 初回ログインフラグ
     * @return bool 更新成功フラグ
     */
    public function updateLoginDate(string $reserverId, bool $isFirstLogin = false): bool
    {
        $data = [
            'last_login_date' => date('Y-m-d H:i:s'),
            'login_flg' => 1
        ];

        if ($isFirstLogin) {
            $data['first_login_date'] = date('Y-m-d H:i:s');
        }

        return $this->update($reserverId, $data);
    }

    /**
     * 支社別予約者一覧を取得
     * 
     * @param string|null $branchCode 支社コード（nullの場合は全件）
     * @return array 予約者一覧
     */
    public function getByBranch(?string $branchCode = null): array
    {
        $builder = $this->orderBy('branch_sort', 'ASC')
                       ->orderBy('id', 'ASC');

        if ($branchCode !== null) {
            $builder->where('branch_code', $branchCode);
        }

        return $builder->findAll();
    }

    /**
     * テストユーザーを除外した予約者一覧を取得
     * 
     * @return array 予約者一覧
     */
    public function getProductionUsers(): array
    {
        return $this->where('test_flg', 0)
                    ->orderBy('branch_sort', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }

    /**
     * 招待枠の残数を取得
     * 
     * @param string $reserverId 予約者ID
     * @return array ['free' => 無料残数, 'charge' => 有料残数]
     */
    public function getInviteBalance(string $reserverId): array
    {
        $reserver = $this->find($reserverId);
        
        if (!$reserver) {
            return ['free' => 0, 'charge' => 0];
        }

        // 実際の使用数は members テーブルから取得する必要がある
        // ここでは基本情報のみ返す
        return [
            'free' => $reserver['free_invites'] ?? 0,
            'charge' => $reserver['charge_invites'] ?? 0
        ];
    }

    /**
     * パスワードをハッシュ化してセット
     * 
     * @param array $data データ配列
     * @return array ハッシュ化後のデータ配列
     */
    protected function hashPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash(
                $data['data']['password'], 
                PASSWORD_DEFAULT
            );
        }

        return $data;
    }

    /**
     * 挿入前コールバック
     * 
     * @param array $data データ配列
     * @return array 加工後のデータ配列
     */
    protected function beforeInsert(array $data): array
    {
        return $this->hashPassword($data);
    }

    /**
     * 更新前コールバック
     * 
     * @param array $data データ配列
     * @return array 加工後のデータ配列
     */
    protected function beforeUpdate(array $data): array
    {
        return $this->hashPassword($data);
    }
}
