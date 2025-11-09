<?php

namespace App\Models\Option;

use CodeIgniter\Model;

/**
 * オプションマスタモデル
 * 
 * オプションツアーの基本情報（料金、営業時間、催行時間など）を管理
 * 
 * @package App\Models\Option
 */
class OptionMasterModel extends Model
{
    /**
     * テーブル名
     * 
     * @var string
     */
    protected $table = 'option_masters';

    /**
     * 主キー（複合キー）
     * 
     * @var array
     */
    protected $primaryKey = ['type', 'option_id'];

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
        'type',
        'option_id',
        'option_id_name',
        'name',
        'price_adult',
        'price_child',
        'business_time',
        'day1_on',
        'day1_time',
        'day2_on',
        'day2_time',
        'day3_on',
        'day3_time',
        'is_golf',
        'sort_order'
    ];

    /**
     * タイムスタンプ使用フラグ
     * 
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * オプション種別でフィルタリング
     * 
     * @param int $type オプション種別
     * @return array オプション一覧
     */
    public function getByType(int $type): array
    {
        return $this->where('type', $type)
                    ->orderBy('sort_order', 'ASC')
                    ->orderBy('option_id', 'ASC')
                    ->findAll();
    }

    /**
     * ゴルフオプションのみ取得
     * 
     * @return array ゴルフオプション一覧
     */
    public function getGolfOptions(): array
    {
        return $this->where('is_golf', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }

    /**
     * 特定日に催行されるオプションを取得
     * 
     * @param int $day 日付（1=1日目, 2=2日目, 3=3日目）
     * @return array オプション一覧
     */
    public function getAvailableByDay(int $day): array
    {
        $field = "day{$day}_on";
        
        return $this->where($field, 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }

    /**
     * オプションの催行時間を配列に変換
     * 
     * @param string $timeText 催行時間テキスト（カンマ区切り）
     * @return array 催行時間配列
     */
    public function parseTimeText(string $timeText): array
    {
        if (empty($timeText)) {
            return [];
        }

        return array_map('trim', explode(',', $timeText));
    }

    /**
     * 料金計算（大人・子供）
     * 
     * @param array $option オプション情報
     * @param int $adultCount 大人人数
     * @param int $childCount 子供人数
     * @return int 合計料金
     */
    public function calculatePrice(array $option, int $adultCount, int $childCount): int
    {
        $adultPrice = ($option['price_adult'] ?? 0) * $adultCount;
        $childPrice = ($option['price_child'] ?? 0) * $childCount;
        
        return $adultPrice + $childPrice;
    }
}
