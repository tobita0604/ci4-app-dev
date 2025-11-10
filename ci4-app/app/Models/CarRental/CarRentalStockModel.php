<?php

namespace App\Models\CarRental;

use CodeIgniter\Model;

/**
 * レンタカー在庫モデル
 * 
 * レンタカーのクラス別・日別在庫管理
 * 
 * @package App\Models\CarRental
 */
class CarRentalStockModel extends Model
{
    /**
     * テーブル名
     * 
     * @var string
     */
    protected $table = 'car_rental_stocks';

    /**
     * 主キー（複合キー）
     * 
     * @var array
     */
    protected $primaryKey = ['class', 'rental_day'];

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
        'class',
        'rental_day',
        'stock',
        'reserve',
        'balance',
        'sort_order'
    ];

    /**
     * タイムスタンプ使用フラグ
     * 
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * クラス別在庫一覧を取得
     * 
     * @param string $class レンタカークラス
     * @return array 在庫一覧
     */
    public function getByClass(string $class): array
    {
        return $this->where('class', $class)
                    ->orderBy('rental_day', 'ASC')
                    ->findAll();
    }

    /**
     * 全クラスの在庫状況を取得
     * 
     * @return array クラス別在庫一覧
     */
    public function getAllStocks(): array
    {
        return $this->orderBy('sort_order', 'ASC')
                    ->orderBy('class', 'ASC')
                    ->orderBy('rental_day', 'ASC')
                    ->findAll();
    }

    /**
     * 在庫残数を更新
     * 
     * @param string $class レンタカークラス
     * @param int $rentalDay レンタル日
     * @param int $reserveCount 予約数変更（正=予約追加、負=予約キャンセル）
     * @return bool 更新成功フラグ
     */
    public function updateStock(string $class, int $rentalDay, int $reserveCount): bool
    {
        $stock = $this->where('class', $class)
                     ->where('rental_day', $rentalDay)
                     ->first();

        if (!$stock) {
            return false;
        }

        $newReserve = $stock['reserve'] + $reserveCount;
        $newBalance = $stock['stock'] - $newReserve;

        // 在庫不足チェック
        if ($newBalance < 0) {
            return false;
        }

        return $this->update(
            ['class' => $class, 'rental_day' => $rentalDay],
            [
                'reserve' => $newReserve,
                'balance' => $newBalance
            ]
        );
    }

    /**
     * 在庫残数をチェック
     * 
     * @param string $class レンタカークラス
     * @param int $rentalDay レンタル日
     * @param int $requiredCount 必要台数
     * @return bool 在庫が十分にあるか
     */
    public function checkAvailability(string $class, int $rentalDay, int $requiredCount = 1): bool
    {
        $stock = $this->where('class', $class)
                     ->where('rental_day', $rentalDay)
                     ->first();

        if (!$stock) {
            return false;
        }

        return $stock['balance'] >= $requiredCount;
    }

    /**
     * 在庫を初期化（管理者用）
     * 
     * @param string $class レンタカークラス
     * @param int $rentalDay レンタル日
     * @param int $stockCount 在庫数
     * @return bool 更新成功フラグ
     */
    public function initializeStock(string $class, int $rentalDay, int $stockCount): bool
    {
        $data = [
            'class' => $class,
            'rental_day' => $rentalDay,
            'stock' => $stockCount,
            'reserve' => 0,
            'balance' => $stockCount
        ];

        // 既存データがあれば更新、なければ挿入
        $existing = $this->where('class', $class)
                        ->where('rental_day', $rentalDay)
                        ->first();

        if ($existing) {
            return $this->update(['class' => $class, 'rental_day' => $rentalDay], $data);
        } else {
            return (bool) $this->insert($data);
        }
    }
}
