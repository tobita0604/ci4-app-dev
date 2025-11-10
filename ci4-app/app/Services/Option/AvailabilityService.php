<?php

namespace App\Services\Option;

use App\Models\Option\OptionTimeModel;
use App\Models\Option\OptionModel;

/**
 * オプション空き状況管理サービス
 * 
 * オプションツアーの在庫・空き状況の管理、更新のビジネスロジックを提供します。
 */
class AvailabilityService
{
    /**
     * @var OptionTimeModel オプション時間別在庫モデル
     */
    protected OptionTimeModel $optionTimeModel;

    /**
     * @var OptionModel オプションモデル
     */
    protected OptionModel $optionModel;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->optionTimeModel = new OptionTimeModel();
        $this->optionModel = new OptionModel();
    }

    /**
     * オプションの空き状況を取得
     * 
     * @param string $optionId オプションID
     * @param int|null $dateFlg 日付フラグ
     * @return array
     */
    public function getAvailability(string $optionId, ?int $dateFlg = null): array
    {
        $stock = $this->optionTimeModel->getStockByOption($optionId, $dateFlg);
        
        return array_map(function ($item) {
            return [
                'stock_id' => $item['stock_id'],
                'time_id' => $item['time_id'],
                'time_text' => $item['time_text'],
                'stock' => $item['stock'],
                'reserve' => $item['reserve'],
                'balance' => $item['balance'],
                'is_available' => $item['balance'] > 0,
            ];
        }, $stock);
    }

    /**
     * 在庫を予約
     * 
     * @param int $stockId 在庫ID
     * @param int $count 予約数
     * @return bool
     */
    public function reserve(int $stockId, int $count = 1): bool
    {
        // 在庫があるかチェック
        if (!$this->optionTimeModel->isAvailable($stockId, $count)) {
            return false;
        }

        // 予約数を増やす
        return $this->optionTimeModel->incrementReserve($stockId, $count);
    }

    /**
     * 予約をキャンセル
     * 
     * @param int $stockId 在庫ID
     * @param int $count キャンセル数
     * @return bool
     */
    public function cancelReservation(int $stockId, int $count = 1): bool
    {
        return $this->optionTimeModel->decrementReserve($stockId, $count);
    }

    /**
     * 在庫を更新
     * 
     * @param int $stockId 在庫ID
     * @param int $newStock 新しい在庫数
     * @return bool
     */
    public function updateStock(int $stockId, int $newStock): bool
    {
        $result = $this->optionTimeModel->update($stockId, ['stock' => $newStock]);
        
        if ($result) {
            // 残数を再計算
            $this->optionTimeModel->updateBalance($stockId);
        }

        return $result;
    }

    /**
     * 全ての在庫の残数を再計算
     * 
     * @return int 更新された件数
     */
    public function recalculateAllBalances(): int
    {
        $allStock = $this->optionTimeModel->findAll();
        $count = 0;

        foreach ($allStock as $stock) {
            if ($this->optionTimeModel->updateBalance($stock['stock_id'])) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * 在庫不足のアイテムを取得
     * 
     * @param int $threshold しきい値（この値以下を取得）
     * @return array
     */
    public function getLowStockItems(int $threshold = 5): array
    {
        return $this->optionTimeModel->where('balance <=', $threshold)
                                      ->where('balance >', 0)
                                      ->orderBy('balance', 'ASC')
                                      ->findAll();
    }

    /**
     * 在庫切れのアイテムを取得
     * 
     * @return array
     */
    public function getOutOfStockItems(): array
    {
        return $this->optionTimeModel->where('balance', 0)->findAll();
    }

    /**
     * 在庫統計情報を取得
     * 
     * @param string|null $optionId オプションID（null=全体）
     * @return array
     */
    public function getStockStatistics(?string $optionId = null): array
    {
        $builder = $this->optionTimeModel->builder();

        if ($optionId !== null) {
            $builder->where('option_id', $optionId);
        }

        $result = $builder->select([
            'SUM(stock) as total_stock',
            'SUM(reserve) as total_reserved',
            'SUM(balance) as total_available',
            'COUNT(*) as total_items',
        ])->get()->getRowArray();

        return [
            'total_stock' => (int) ($result['total_stock'] ?? 0),
            'total_reserved' => (int) ($result['total_reserved'] ?? 0),
            'total_available' => (int) ($result['total_available'] ?? 0),
            'total_items' => (int) ($result['total_items'] ?? 0),
        ];
    }
}
