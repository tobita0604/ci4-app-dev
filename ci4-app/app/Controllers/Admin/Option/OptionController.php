<?php

namespace App\Controllers\Admin\Option;

use App\Controllers\BaseController;
use App\Services\Option\OptionService;
use App\Services\Option\AvailabilityService;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * オプション管理コントローラー
 * 
 * 管理画面でのオプション（ツアー・アクティビティ）の管理機能を提供します。
 * オプションの一覧表示、詳細表示、編集、在庫管理などを行います。
 */
class OptionController extends BaseController
{
    /**
     * @var OptionService オプション関連サービス
     */
    protected OptionService $optionService;

    /**
     * @var AvailabilityService 在庫・空き状況管理サービス
     */
    protected AvailabilityService $availabilityService;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        // TODO: サービス実装後にインスタンス化
        // $this->optionService = new OptionService();
        // $this->availabilityService = new AvailabilityService();
    }

    /**
     * オプション一覧表示
     * 
     * @return string|ResponseInterface
     */
    public function index()
    {
        $data = [
            'title' => 'オプション一覧',
            'options' => [], // TODO: サービス層から取得
        ];

        return view('admin/option/list', $data);
    }

    /**
     * オプション詳細表示
     * 
     * @param string $id オプションID
     * @return string|ResponseInterface
     */
    public function show($id)
    {
        $data = [
            'title' => 'オプション詳細',
            'option' => [], // TODO: サービス層から取得
        ];

        return view('admin/option/detail', $data);
    }

    /**
     * オプション編集フォーム表示
     * 
     * @param string $id オプションID
     * @return string|ResponseInterface
     */
    public function edit($id)
    {
        $data = [
            'title' => 'オプション編集',
            'option' => [], // TODO: サービス層から取得
        ];

        return view('admin/option/edit', $data);
    }

    /**
     * オプション情報更新
     * 
     * @param string $id オプションID
     * @return RedirectResponse
     */
    public function update($id): RedirectResponse
    {
        // TODO: 実装
        return $this->response->redirect(site_url('/admin/option'));
    }

    /**
     * オプション在庫管理画面表示
     * 
     * @param string $id オプションID
     * @return string|ResponseInterface
     */
    public function stock($id)
    {
        $data = [
            'title' => 'オプション在庫管理',
            'option' => [], // TODO: サービス層から取得
            'stock' => [], // TODO: サービス層から取得
        ];

        return view('admin/option/stock', $data);
    }
}
