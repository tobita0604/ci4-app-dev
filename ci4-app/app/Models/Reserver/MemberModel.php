<?php

namespace App\Models\Reserver;

use CodeIgniter\Model;

/**
 * メンバーモデル
 * 
 * 旅行参加メンバーの詳細情報を管理するモデル
 * パスポート情報、ESTA、緊急連絡先、ベビー・幼児オプション等を含む
 * 
 * @package App\Models\Reserver
 */
class MemberModel extends Model
{
    /**
     * テーブル名
     * 
     * @var string
     */
    protected $table = 'members';

    /**
     * 主キー（複合キー）
     * 
     * @var array
     */
    protected $primaryKey = ['reserver_id', 'seq'];

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
        'reserver_id',
        'seq',
        'name',
        'name_last',
        'name_first',
        'roma_last',
        'roma_first',
        'birthdate',
        'age',
        'gender',
        'relationship',
        'mobile_no',
        'email',
        'passport_flg',
        'passport_no',
        'passport_issue_date',
        'passport_valid_date',
        'passport_img',
        'passport_date',
        'esta_flg',
        'nationality',
        'postal1',
        'postal2',
        'prefecture',
        'address',
        'address2',
        'address3',
        'tel_no',
        'emer_name',
        'emer_relationship',
        'emer_tel_no',
        'baby_meal',
        'baby_bassinet',
        'baby_height',
        'baby_weight',
        'baby_chair',
        'baby_bed',
        'baby_bed2',
        'baby_car',
        'infant_bed',
        'infant_party',
        'infant_meal',
        'infant_chair',
        'infant_bassinet',
        'entry_flg',
        'cancel_flg'
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
        'reserver_id' => 'required|max_length[15]',
        'seq' => 'required|integer',
        'name_last' => 'required|max_length[10]',
        'name_first' => 'required|max_length[10]',
        'roma_last' => 'required|max_length[50]',
        'roma_first' => 'required|max_length[50]',
        'birthdate' => 'required|valid_date',
        'email' => 'required|valid_email|max_length[100]',
        'mobile_no' => 'required|max_length[20]'
    ];

    /**
     * バリデーションメッセージ
     * 
     * @var array
     */
    protected $validationMessages = [
        'name_last' => [
            'required' => '姓は必須です'
        ],
        'name_first' => [
            'required' => '名は必須です'
        ],
        'email' => [
            'required' => 'メールアドレスは必須です',
            'valid_email' => 'メールアドレスの形式が不正です'
        ]
    ];

    /**
     * 予約者IDでメンバー一覧を取得
     * 
     * @param string $reserverId 予約者ID
     * @param bool $excludeCanceled キャンセル済みを除外するか
     * @return array メンバー一覧
     */
    public function getByReserver(string $reserverId, bool $excludeCanceled = true): array
    {
        $builder = $this->where('reserver_id', $reserverId)
                       ->orderBy('seq', 'ASC');

        if ($excludeCanceled) {
            $builder->where('cancel_flg', 0);
        }

        return $builder->findAll();
    }

    /**
     * 次のシーケンス番号を取得
     * 
     * @param string $reserverId 予約者ID
     * @return int 次のシーケンス番号
     */
    public function getNextSeq(string $reserverId): int
    {
        $result = $this->selectMax('seq')
                      ->where('reserver_id', $reserverId)
                      ->first();

        return ($result['seq'] ?? 0) + 1;
    }

    /**
     * メンバーの年齢を計算
     * 
     * @param string $birthdate 生年月日（YYYY-MM-DD）
     * @param string|null $baseDate 基準日（nullの場合は今日）
     * @return int 年齢
     */
    public function calculateAge(string $birthdate, ?string $baseDate = null): int
    {
        $birth = new \DateTime($birthdate);
        $base = $baseDate ? new \DateTime($baseDate) : new \DateTime();
        
        $age = $base->diff($birth)->y;
        
        return $age;
    }

    /**
     * パスポート有効期限チェック
     * 
     * @param string $validDate パスポート有効期限（YYYY-MM-DD）
     * @param int $requiredMonths 必要な残存有効期間（月数）
     * @return bool 有効期限が十分か
     */
    public function checkPassportValidity(string $validDate, int $requiredMonths = 6): bool
    {
        $valid = new \DateTime($validDate);
        $required = new \DateTime();
        $required->modify("+{$requiredMonths} months");
        
        return $valid >= $required;
    }

    /**
     * メンバー情報の登録完了判定
     * 
     * @param array $member メンバー情報
     * @return bool 登録完了しているか
     */
    public function isEntryComplete(array $member): bool
    {
        // 必須項目のチェック
        $requiredFields = [
            'name_last',
            'name_first',
            'roma_last',
            'roma_first',
            'birthdate',
            'email',
            'mobile_no'
        ];

        foreach ($requiredFields as $field) {
            if (empty($member[$field])) {
                return false;
            }
        }

        // パスポート情報のチェック（海外旅行の場合）
        if (!empty($member['passport_flg'])) {
            $passportFields = [
                'passport_no',
                'passport_issue_date',
                'passport_valid_date'
            ];

            foreach ($passportFields as $field) {
                if (empty($member[$field])) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * ベビー・幼児オプションが設定されているか
     * 
     * @param array $member メンバー情報
     * @return bool オプション設定済みか
     */
    public function hasBabyOptions(array $member): bool
    {
        $babyFields = [
            'baby_meal',
            'baby_bassinet',
            'baby_chair',
            'baby_bed',
            'baby_car',
            'infant_bed',
            'infant_meal'
        ];

        foreach ($babyFields as $field) {
            if (!empty($member[$field])) {
                return true;
            }
        }

        return false;
    }

    /**
     * 挿入前コールバック - フルネームを生成
     * 
     * @param array $data データ配列
     * @return array 加工後のデータ配列
     */
    protected function beforeInsert(array $data): array
    {
        if (isset($data['data']['name_last']) && isset($data['data']['name_first'])) {
            $data['data']['name'] = $data['data']['name_last'] . ' ' . $data['data']['name_first'];
        }

        // 年齢を自動計算
        if (isset($data['data']['birthdate'])) {
            $data['data']['age'] = $this->calculateAge($data['data']['birthdate']);
        }

        return $data;
    }

    /**
     * 更新前コールバック - フルネームを生成
     * 
     * @param array $data データ配列
     * @return array 加工後のデータ配列
     */
    protected function beforeUpdate(array $data): array
    {
        if (isset($data['data']['name_last']) && isset($data['data']['name_first'])) {
            $data['data']['name'] = $data['data']['name_last'] . ' ' . $data['data']['name_first'];
        }

        // 年齢を自動計算
        if (isset($data['data']['birthdate'])) {
            $data['data']['age'] = $this->calculateAge($data['data']['birthdate']);
        }

        return $data;
    }
}
