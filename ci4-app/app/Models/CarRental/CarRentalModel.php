<?php

namespace App\Models\CarRental;

use CodeIgniter\Model;

/**
 * レンタカー予約モデル
 * 
 * レンタカー予約情報と運転免許証情報を管理
 * 
 * @package App\Models\CarRental
 */
class CarRentalModel extends Model
{
    /**
     * テーブル名
     * 
     * @var string
     */
    protected $table = 'car_rentals';

    /**
     * 主キー
     * 
     * @var string
     */
    protected $primaryKey = 'user_id';

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
     * 許可されたフィールド
     * 
     * @var array
     */
    protected $allowedFields = [
        'user_id',
        'name_kanji',
        'name_kana',
        'driver_license_no',
        'driver_license_expiry',
        'class',
        'from_drive_date',
        'from_drive_time',
        'to_drive_date',
        'to_drive_time',
        'car_insurance',
        'child_seat',
        'regist_flg'
    ];

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
        'user_id' => 'required|max_length[20]',
        'name_kanji' => 'required|max_length[50]',
        'name_kana' => 'required|max_length[50]',
        'driver_license_no' => 'required|max_length[20]',
        'driver_license_expiry' => 'required|valid_date',
        'class' => 'required|max_length[2]',
        'from_drive_date' => 'required|valid_date',
        'to_drive_date' => 'required|valid_date'
    ];

    /**
     * バリデーションメッセージ
     * 
     * @var array
     */
    protected $validationMessages = [
        'driver_license_no' => [
            'required' => '運転免許証番号は必須です'
        ],
        'driver_license_expiry' => [
            'required' => '運転免許証有効期限は必須です',
            'valid_date' => '有効期限の形式が不正です'
        ]
    ];

    /**
     * クラス別予約一覧を取得
     * 
     * @param string $class レンタカークラス
     * @return array 予約一覧
     */
    public function getByClass(string $class): array
    {
        return $this->where('class', $class)
                    ->orderBy('from_drive_date', 'ASC')
                    ->findAll();
    }

    /**
     * 日付範囲で予約一覧を取得
     * 
     * @param string $fromDate 開始日
     * @param string $toDate 終了日
     * @return array 予約一覧
     */
    public function getByDateRange(string $fromDate, string $toDate): array
    {
        return $this->where('from_drive_date >=', $fromDate)
                    ->where('to_drive_date <=', $toDate)
                    ->orderBy('from_drive_date', 'ASC')
                    ->findAll();
    }

    /**
     * 運転免許証有効期限チェック
     * 
     * @param string $expiryDate 有効期限（YYYY-MM-DD）
     * @param string $driveDate 貸出日（YYYY-MM-DD）
     * @return bool 有効か
     */
    public function checkLicenseValidity(string $expiryDate, string $driveDate): bool
    {
        $expiry = new \DateTime($expiryDate);
        $drive = new \DateTime($driveDate);
        
        return $expiry >= $drive;
    }

    /**
     * レンタル日数を計算
     * 
     * @param string $fromDate 貸出日
     * @param string $toDate 返却日
     * @return int レンタル日数
     */
    public function calculateRentalDays(string $fromDate, string $toDate): int
    {
        $from = new \DateTime($fromDate);
        $to = new \DateTime($toDate);
        
        $diff = $from->diff($to);
        
        return $diff->days + 1; // 貸出日を含む
    }
}
