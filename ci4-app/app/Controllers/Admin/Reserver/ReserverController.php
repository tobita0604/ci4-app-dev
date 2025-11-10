<?php

namespace App\Controllers\Admin\Reserver;

use App\Controllers\BaseController;
use App\Services\Reservation\ReservationService;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * 予約者管理コントローラー
 * 
 * 管理画面での予約者情報の一覧表示、詳細表示、編集、削除機能を提供します。
 * ビジネスロジックはReservationServiceに委譲し、コントローラーは
 * リクエストの処理とレスポンスの返却に専念します。
 */
class ReserverController extends BaseController
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
     * 予約者一覧表示
     * 
     * @return string|ResponseInterface
     */
    public function index()
    {
        $data = [
            'title' => '予約者一覧',
            'reservations' => [], // TODO: サービス層から取得
        ];

        return view('admin/reserver/list', $data);
    }

    /**
     * 予約者詳細表示
     * 
     * @param int $id 予約者ID
     * @return string|ResponseInterface
     */
    public function show($id)
    {
        $data = [
            'title' => '予約者詳細',
            'reservation' => [], // TODO: サービス層から取得
        ];

        return view('admin/reserver/detail', $data);
    }

    /**
     * 予約者編集フォーム表示
     * 
     * @param int $id 予約者ID
     * @return string|ResponseInterface
     */
    public function edit($id)
    {
        $data = [
            'title' => '予約者編集',
            'reservation' => [], // TODO: サービス層から取得
        ];

        return view('admin/reserver/edit', $data);
    }

    /**
     * 予約者情報更新
     * 
     * @param int $id 予約者ID
     * @return ResponseInterface
     */
    public function update($id)
    {
        // TODO: 実装
        return redirect()->to('/admin/reserver');
    }

    /**
     * 予約者削除
     * 
     * @param int $id 予約者ID
     * @return ResponseInterface
     */
    public function delete($id)
    {
        // TODO: 実装
        return redirect()->to('/admin/reserver');
    }
}
