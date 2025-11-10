<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * 担当者モデル
 * 
 * 営業担当者、オーガナイザー、管理者（KNT）の情報を管理するモデル
 * 
 * @package App\Models
 */
class ChargerModel extends Model
{
    /**
     * テーブル名
     * 
     * @var string
     */
    protected $table = 'chargers';

    /**
     * 主キー
     * 
     * @var string
     */
    protected $primaryKey = 'charger_id';

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
        'charger_id',
        'charger_password',
        'charger_name',
        'charger_type'
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
        'charger_id' => 'required|max_length[50]|is_unique[chargers.charger_id,charger_id,{charger_id}]',
        'charger_password' => 'required|min_length[8]',
        'charger_name' => 'permit_empty|max_length[100]',
        'charger_type' => 'required|in_list[0,1,9]'
    ];

    /**
     * バリデーションメッセージ
     * 
     * @var array
     */
    protected $validationMessages = [
        'charger_id' => [
            'required' => '担当者IDは必須です',
            'is_unique' => 'この担当者IDは既に使用されています'
        ],
        'charger_password' => [
            'required' => 'パスワードは必須です',
            'min_length' => 'パスワードは8文字以上で入力してください'
        ],
        'charger_type' => [
            'required' => '担当者種別は必須です',
            'in_list' => '担当者種別が不正です'
        ]
    ];

    /**
     * 担当者種別の定数
     */
    public const TYPE_SALES = 0;      // 営業担当者
    public const TYPE_ORGANIZER = 1;  // オーガナイザー
    public const TYPE_ADMIN = 9;      // 管理者（KNT）

    /**
     * 担当者IDでログイン認証
     * 
     * @param string $chargerId 担当者ID
     * @param string $password パスワード（平文）
     * @return array|null 担当者情報 or null
     */
    public function authenticate(string $chargerId, string $password): ?array
    {
        $charger = $this->where('charger_id', $chargerId)->first();
        
        if (!$charger) {
            return null;
        }

        // パスワード検証
        if (password_verify($password, $charger['charger_password'])) {
            return $charger;
        }

        return null;
    }

    /**
     * 担当者種別名を取得
     * 
     * @param int $type 担当者種別
     * @return string 担当者種別名
     */
    public static function getTypeName(int $type): string
    {
        return match($type) {
            self::TYPE_SALES => '営業担当者',
            self::TYPE_ORGANIZER => 'オーガナイザー',
            self::TYPE_ADMIN => '管理者（KNT）',
            default => '不明'
        };
    }

    /**
     * パスワードをハッシュ化してセット
     * 
     * @param array $data データ配列
     * @return array ハッシュ化後のデータ配列
     */
    protected function hashPassword(array $data): array
    {
        if (isset($data['data']['charger_password'])) {
            $data['data']['charger_password'] = password_hash(
                $data['data']['charger_password'], 
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
