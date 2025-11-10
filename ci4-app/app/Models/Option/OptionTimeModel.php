<?php

namespace App\Models\Option;

use CodeIgniter\Model;

/**
 * オプション時間別在庫モデル
 * 
 * オプションツアーの時間帯別在庫管理を提供します。
 * option_timesテーブルへのアクセスを提供します。
 */
class OptionTimeModel extends Model
{
    /**
     * @var string テーブル名
     */
    protected $table = 'option_times';

    /**
     * @var string 主キー
     */
    protected $primaryKey = 'stock_id';

    /**
     * @var bool 自動インクリメント使用
     */
    protected $useAutoIncrement = true;

    /**
     * @var string 戻り値の型
     */
    protected $returnType = 'array';

    /**
     * @var bool ソフトデリート使用
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool タイムスタンプ使用
     */
    protected $useTimestamps = true;

    /**
     * @var array 許可するフィールド
     */
    protected $allowedFields = [
        'option_id',
        'time_id',
        'stock',
        'reserve',
        'balance',
        'date_flg',
        'time_text',
    ];

    /**
     * @var array バリデーションルール
     */
    protected $validationRules = [
        'option_id' => 'required|max_length[5]',
        'time_id' => 'required|integer',
        'stock' => 'required|integer',
        'date_flg' => 'required|in_list[1,2]',
    ];

    /**
     * @var array バリデーションメッセージ
     */
    protected $validationMessages = [
        'option_id' => [
            'required' => 'オプションIDは必須です',
        ],
        'time_id' => [
            'required' => '時間IDは必須です',
        ],
    ];

    /**
     * 日付フラグ定数
     */
    public const DATE_23RD = 1;  // 23日
    public const DATE_24TH = 2;  // 24日

    /**
     * 特定のオプションの在庫情報を取得
     * 
     * @param string $optionId オプションID
     * @param int|null $dateFlg 日付フラグ（null=全て）
     * @return array
     */
    public function getStockByOption(string $optionId, ?int $dateFlg = null): array
    {
        $builder = $this->where('option_id', $optionId);
        
        if ($dateFlg !== null) {
            $builder->where('date_flg', $dateFlg);
        }

        return $builder->orderBy('time_id', 'ASC')->findAll();
    }

    /**
     * 在庫の残数を更新
     * 
     * @param int $stockId 在庫ID
     * @return bool
     */
    public function updateBalance(int $stockId): bool
    {
        $stock = $this->find($stockId);
        
        if (!$stock) {
            return false;
        }

        $balance = $stock['stock'] - $stock['reserve'];
        
        return $this->update($stockId, ['balance' => $balance]);
    }

    /**
     * 予約数を増やす
     * 
     * @param int $stockId 在庫ID
     * @param int $count 増加数
     * @return bool
     */
    public function incrementReserve(int $stockId, int $count = 1): bool
    {
        $stock = $this->find($stockId);
        
        if (!$stock) {
            return false;
        }

        $newReserve = $stock['reserve'] + $count;
        $newBalance = $stock['stock'] - $newReserve;

        // 在庫不足チェック
        if ($newBalance < 0) {
            return false;
        }

        return $this->update($stockId, [
            'reserve' => $newReserve,
            'balance' => $newBalance,
        ]);
    }

    /**
     * 予約数を減らす
     * 
     * @param int $stockId 在庫ID
     * @param int $count 減少数
     * @return bool
     */
    public function decrementReserve(int $stockId, int $count = 1): bool
    {
        $stock = $this->find($stockId);
        
        if (!$stock) {
            return false;
        }

        $newReserve = max(0, $stock['reserve'] - $count);
        $newBalance = $stock['stock'] - $newReserve;

        return $this->update($stockId, [
            'reserve' => $newReserve,
            'balance' => $newBalance,
        ]);
    }

    /**
     * 在庫が利用可能かチェック
     * 
     * @param int $stockId 在庫ID
     * @param int $requestCount 要求数
     * @return bool
     */
    public function isAvailable(int $stockId, int $requestCount = 1): bool
    {
        $stock = $this->find($stockId);
        
        if (!$stock) {
            return false;
        }

        return $stock['balance'] >= $requestCount;
    }
}
