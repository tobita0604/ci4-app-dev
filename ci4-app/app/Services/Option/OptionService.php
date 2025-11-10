<?php

namespace App\Services\Option;

use App\Models\Option\OptionModel;
use App\Models\Option\OptionTimeModel;
use App\Models\Option\OptionReservationModel;

/**
 * オプション関連サービス
 * 
 * オプションツアーの管理、予約、料金計算などのビジネスロジックを提供します。
 */
class OptionService
{
    /**
     * @var OptionModel オプションモデル
     */
    protected OptionModel $optionModel;

    /**
     * @var OptionTimeModel オプション時間別在庫モデル
     */
    protected OptionTimeModel $optionTimeModel;

    /**
     * @var OptionReservationModel オプション予約モデル
     */
    protected OptionReservationModel $optionReservationModel;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->optionModel = new OptionModel();
        $this->optionTimeModel = new OptionTimeModel();
        $this->optionReservationModel = new OptionReservationModel();
    }

    /**
     * オプション一覧を取得
     * 
     * @param int|null $type オプション種別（null=全て）
     * @return array
     */
    public function getOptions(?int $type = null): array
    {
        if ($type !== null) {
            return $this->optionModel->getByType($type);
        }

        return $this->optionModel->findAll();
    }

    /**
     * オプション詳細を取得
     * 
     * @param int $type オプション種別
     * @param string $optionId オプションID
     * @return array|null
     */
    public function getOption(int $type, string $optionId): ?array
    {
        return $this->optionModel->where('type', $type)
                                  ->where('option_id', $optionId)
                                  ->first();
    }

    /**
     * 特定日に利用可能なオプションを取得
     * 
     * @param int $day 日付（1=1日目, 2=2日目, 3=3日目）
     * @return array
     */
    public function getAvailableOptionsByDay(int $day): array
    {
        return $this->optionModel->getAvailableByDay($day);
    }

    /**
     * ゴルフオプションを取得
     * 
     * @return array
     */
    public function getGolfOptions(): array
    {
        return $this->optionModel->getGolfOptions();
    }

    /**
     * オプションの在庫状況を取得
     * 
     * @param string $optionId オプションID
     * @param int|null $dateFlg 日付フラグ
     * @return array
     */
    public function getStockStatus(string $optionId, ?int $dateFlg = null): array
    {
        return $this->optionTimeModel->getStockByOption($optionId, $dateFlg);
    }

    /**
     * オプションが予約可能かチェック
     * 
     * @param int $stockId 在庫ID
     * @param int $requestCount 要求数
     * @return bool
     */
    public function isOptionAvailable(int $stockId, int $requestCount = 1): bool
    {
        return $this->optionTimeModel->isAvailable($stockId, $requestCount);
    }

    /**
     * オプション予約を作成
     * 
     * @param array $reservationData 予約データ
     * @return bool
     */
    public function createReservation(array $reservationData): bool
    {
        // TODO: トランザクション処理実装
        return $this->optionReservationModel->insert($reservationData) !== false;
    }

    /**
     * オプション料金を計算
     * 
     * @param array $option オプション情報
     * @param int $adultCount 大人人数
     * @param int $childCount 子供人数
     * @return int 合計料金
     */
    public function calculatePrice(array $option, int $adultCount, int $childCount): int
    {
        return $this->optionModel->calculatePrice($option, $adultCount, $childCount);
    }

    /**
     * 予約者のオプション予約一覧を取得
     * 
     * @param string $reserverId 予約者ID
     * @return array
     */
    public function getReservationsByReserver(string $reserverId): array
    {
        return $this->optionReservationModel->getByReserver($reserverId);
    }

    /**
     * ゴルフ予約一覧を取得
     * 
     * @return array
     */
    public function getGolfReservations(): array
    {
        return $this->optionReservationModel->getGolfReservations();
    }
}
