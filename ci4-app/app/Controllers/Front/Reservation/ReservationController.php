<?php

namespace App\Controllers\Front\Reservation;

use App\Controllers\BaseController;
use App\Services\Reservation\ReservationService;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * フロント予約コントローラー
 * 
 * フロントサイトでの予約プロセス（ステップ1〜確認画面〜完了）を提供します。
 * ビジネスロジックはReservationServiceに委譲します。
 */
class ReservationController extends BaseController
{
    /**
     * @var ReservationService 予約関連サービス
     */
    protected ReservationService $reservationService;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->reservationService = new ReservationService();
    }

    /**
     * 予約フォーム ステップ1（基本情報入力）
     * 
     * @return string|ResponseInterface
     */
    public function step1()
    {
        $data = [
            'title' => '予約情報入力',
        ];

        return view('front/reservation/step1', $data);
    }

    /**
     * 予約フォーム ステップ2（オプション選択）
     * 
     * @return string|ResponseInterface
     */
    public function step2()
    {
        // セッションから基本情報を取得
        $reservationData = session()->get('reservation_step1');
        
        if (!$reservationData) {
            return redirect()->to('/reservation/step1');
        }

        $data = [
            'title' => 'オプション選択',
            'reservationData' => $reservationData,
        ];

        return view('front/reservation/step2', $data);
    }

    /**
     * 予約内容確認画面
     * 
     * @return string|ResponseInterface
     */
    public function confirm()
    {
        // セッションから予約情報を取得
        $reservationData = session()->get('reservation_step1');
        $optionData = session()->get('reservation_step2');
        
        if (!$reservationData || !$optionData) {
            return redirect()->to('/reservation/step1');
        }

        $data = [
            'title' => '予約内容確認',
            'reservationData' => $reservationData,
            'optionData' => $optionData,
        ];

        return view('front/reservation/confirm', $data);
    }

    /**
     * 予約完了処理
     * 
     * @return ResponseInterface
     */
    public function complete()
    {
        // TODO: 予約データの保存処理実装
        
        // セッションクリア
        session()->remove('reservation_step1');
        session()->remove('reservation_step2');

        return redirect()->to('/reservation/thanks')->with('success', '予約が完了しました');
    }

    /**
     * 予約完了画面
     * 
     * @return string|ResponseInterface
     */
    public function thanks()
    {
        $data = [
            'title' => '予約完了',
        ];

        return view('front/reservation/thanks', $data);
    }
}
