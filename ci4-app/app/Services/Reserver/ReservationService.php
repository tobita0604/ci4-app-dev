<?php

namespace App\Services\Reserver;

use App\Models\Reserver\ReserverModel;
use App\Models\Reserver\MemberModel;
use App\Models\Option\OptionReservationModel;
use App\Models\CarRental\CarRentalModel;

/**
 * 予約管理サービス
 * 
 * 予約者、メンバー、オプション、レンタカーの予約管理を統合的に行うサービス
 * 
 * @package App\Services\Reserver
 */
class ReservationService
{
    /**
     * 予約者モデル
     * 
     * @var ReserverModel
     */
    protected ReserverModel $reserverModel;

    /**
     * メンバーモデル
     * 
     * @var MemberModel
     */
    protected MemberModel $memberModel;

    /**
     * オプション予約モデル
     * 
     * @var OptionReservationModel
     */
    protected OptionReservationModel $optionReservationModel;

    /**
     * レンタカー予約モデル
     * 
     * @var CarRentalModel
     */
    protected CarRentalModel $carRentalModel;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->reserverModel = new ReserverModel();
        $this->memberModel = new MemberModel();
        $this->optionReservationModel = new OptionReservationModel();
        $this->carRentalModel = new CarRentalModel();
    }

    /**
     * 予約者の詳細情報を取得（メンバー・オプション・レンタカーを含む）
     * 
     * @param string $reserverId 予約者ID
     * @return array|null 予約詳細情報 or null
     */
    public function getReservationDetails(string $reserverId): ?array
    {
        // 予約者基本情報
        $reserver = $this->reserverModel->find($reserverId);
        
        if (!$reserver) {
            return null;
        }

        // メンバー一覧
        $members = $this->memberModel->getByReserver($reserverId);

        // オプション予約一覧
        $optionReservations = $this->optionReservationModel->getByReserver($reserverId);

        // レンタカー予約
        $carRental = $this->carRentalModel->find($reserverId);

        return [
            'reserver' => $reserver,
            'members' => $members,
            'option_reservations' => $optionReservations,
            'car_rental' => $carRental
        ];
    }

    /**
     * メンバーを追加
     * 
     * @param string $reserverId 予約者ID
     * @param array $memberData メンバー情報
     * @return int|false 挿入ID or false
     */
    public function addMember(string $reserverId, array $memberData)
    {
        // 次のシーケンス番号を取得
        $seq = $this->memberModel->getNextSeq($reserverId);

        $memberData['reserver_id'] = $reserverId;
        $memberData['seq'] = $seq;

        return $this->memberModel->insert($memberData);
    }

    /**
     * メンバーを更新
     * 
     * @param string $reserverId 予約者ID
     * @param int $seq メンバー連番
     * @param array $memberData メンバー情報
     * @return bool 更新成功フラグ
     */
    public function updateMember(string $reserverId, int $seq, array $memberData): bool
    {
        return $this->memberModel->update(
            ['reserver_id' => $reserverId, 'seq' => $seq],
            $memberData
        );
    }

    /**
     * メンバーをキャンセル（論理削除）
     * 
     * @param string $reserverId 予約者ID
     * @param int $seq メンバー連番
     * @return bool キャンセル成功フラグ
     */
    public function cancelMember(string $reserverId, int $seq): bool
    {
        return $this->memberModel->update(
            ['reserver_id' => $reserverId, 'seq' => $seq],
            ['cancel_flg' => 1]
        );
    }

    /**
     * 予約完了メンバー数を取得
     * 
     * @param string $reserverId 予約者ID
     * @return int 完了メンバー数
     */
    public function getCompletedMemberCount(string $reserverId): int
    {
        $members = $this->memberModel->getByReserver($reserverId, true);
        
        $completedCount = 0;
        foreach ($members as $member) {
            if ($this->memberModel->isEntryComplete($member)) {
                $completedCount++;
            }
        }

        return $completedCount;
    }

    /**
     * 招待枠の使用状況を取得
     * 
     * @param string $reserverId 予約者ID
     * @return array ['free_used' => 無料使用数, 'charge_used' => 有料使用数, 'free_remain' => 無料残数, 'charge_remain' => 有料残数]
     */
    public function getInviteUsage(string $reserverId): array
    {
        $reserver = $this->reserverModel->find($reserverId);
        $members = $this->memberModel->getByReserver($reserverId, true);

        if (!$reserver) {
            return [
                'free_used' => 0,
                'charge_used' => 0,
                'free_remain' => 0,
                'charge_remain' => 0
            ];
        }

        $freeInvites = $reserver['free_invites'] ?? 0;
        $chargeInvites = $reserver['charge_invites'] ?? 0;
        $memberCount = count($members);

        // 無料招待枠から使用
        $freeUsed = min($memberCount, $freeInvites);
        $chargeUsed = max(0, $memberCount - $freeInvites);

        return [
            'free_used' => $freeUsed,
            'charge_used' => $chargeUsed,
            'free_remain' => $freeInvites - $freeUsed,
            'charge_remain' => $chargeInvites - $chargeUsed
        ];
    }

    /**
     * 追加メンバーが可能かチェック
     * 
     * @param string $reserverId 予約者ID
     * @return bool 追加可能か
     */
    public function canAddMember(string $reserverId): bool
    {
        $usage = $this->getInviteUsage($reserverId);
        
        // 無料または有料枠が残っていれば追加可能
        return ($usage['free_remain'] > 0) || ($usage['charge_remain'] > 0);
    }

    /**
     * 予約全体のステータスを取得
     * 
     * @param string $reserverId 予約者ID
     * @return array ステータス情報
     */
    public function getReservationStatus(string $reserverId): array
    {
        $members = $this->memberModel->getByReserver($reserverId, true);
        $totalMembers = count($members);
        $completedMembers = 0;
        $passportCompleted = 0;

        foreach ($members as $member) {
            if ($this->memberModel->isEntryComplete($member)) {
                $completedMembers++;
            }
            if (!empty($member['passport_no'])) {
                $passportCompleted++;
            }
        }

        $completionRate = $totalMembers > 0 
            ? round(($completedMembers / $totalMembers) * 100, 1)
            : 0;

        return [
            'total_members' => $totalMembers,
            'completed_members' => $completedMembers,
            'passport_completed' => $passportCompleted,
            'completion_rate' => $completionRate,
            'is_complete' => $completedMembers === $totalMembers && $totalMembers > 0
        ];
    }

    /**
     * 予約者情報を更新
     * 
     * @param string $reserverId 予約者ID
     * @param array $data 更新データ
     * @return bool 更新成功フラグ
     */
    public function updateReserver(string $reserverId, array $data): bool
    {
        return $this->reserverModel->update($reserverId, $data);
    }

    /**
     * 支社別予約者一覧を取得
     * 
     * @param string|null $branchCode 支社コード
     * @return array 予約者一覧（各予約者の基本情報とメンバー数を含む）
     */
    public function getReserversByBranch(?string $branchCode = null): array
    {
        $reservers = $this->reserverModel->getByBranch($branchCode);
        
        $result = [];
        foreach ($reservers as $reserver) {
            $members = $this->memberModel->getByReserver($reserver['id'], true);
            
            $result[] = array_merge($reserver, [
                'member_count' => count($members),
                'status' => $this->getReservationStatus($reserver['id'])
            ]);
        }

        return $result;
    }
}
