<?php

namespace App\Controllers\Admin\Template;

use App\Controllers\BaseController;
use App\Services\Template\TemplateService;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * テンプレートコントローラー
 * 
 * テンプレートのCRUD操作、プレビュー、複製機能を提供
 */
class TemplateController extends BaseController
{
    protected TemplateService $templateService;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->templateService = new TemplateService();
    }

    /**
     * テンプレート一覧表示
     * 
     * @return string|ResponseInterface
     */
    public function index()
    {
        $data = [
            'title' => 'テンプレート一覧',
            'pagetitle' => 'テンプレート管理',
        ];

        return view('admin/template/list', $data);
    }

    /**
     * テンプレート新規作成フォーム表示
     * 
     * @return string|ResponseInterface
     */
    public function new()
    {
        $data = [
            'title' => 'テンプレート作成',
            'pagetitle' => 'テンプレート管理',
        ];

        return view('admin/template/create', $data);
    }

    /**
     * テンプレート作成処理
     * 
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        // TODO: バリデーション、サービス層での処理実装
        return $this->response->redirect(site_url('/admin/templates'));
    }

    /**
     * テンプレート詳細表示
     * 
     * @param int $id テンプレートID
     * @return string|ResponseInterface
     */
    public function show($id = null)
    {
        $data = [
            'title' => 'テンプレート詳細',
            'pagetitle' => 'テンプレート管理',
            'id' => $id,
        ];

        return view('admin/template/show', $data);
    }

    /**
     * テンプレート編集フォーム表示
     * 
     * @param int $id テンプレートID
     * @return string|ResponseInterface
     */
    public function edit($id = null)
    {
        $data = [
            'title' => 'テンプレート編集',
            'pagetitle' => 'テンプレート管理',
            'id' => $id,
        ];

        return view('admin/template/edit', $data);
    }

    /**
     * テンプレート更新処理
     * 
     * @param int $id テンプレートID
     * @return RedirectResponse
     */
    public function update($id = null): RedirectResponse
    {
        // TODO: バリデーション、サービス層での処理実装
        return $this->response->redirect(site_url('/admin/templates/' . $id));
    }

    /**
     * テンプレート削除処理
     * 
     * @param int $id テンプレートID
     * @return RedirectResponse
     */
    public function delete($id = null): RedirectResponse
    {
        // TODO: サービス層での削除処理実装
        return $this->response->redirect(site_url('/admin/templates'));
    }

    /**
     * テンプレートプレビュー
     * 
     * @param int $id テンプレートID
     * @return string|ResponseInterface
     */
    public function preview($id = null)
    {
        $data = [
            'title' => 'テンプレートプレビュー',
            'id' => $id,
        ];

        return view('admin/template/preview', $data);
    }

    /**
     * テンプレート複製処理
     * 
     * @param int $id テンプレートID
     * @return RedirectResponse
     */
    public function duplicate($id = null): RedirectResponse
    {
        // TODO: サービス層での複製処理実装
        return $this->response->redirect(site_url('/admin/templates'));
    }
}
