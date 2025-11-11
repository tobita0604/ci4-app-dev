<?php

namespace App\Controllers\Admin\Template;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * カテゴリコントローラー
 * 
 * テンプレートカテゴリのCRUD操作を提供
 */
class CategoryController extends BaseController
{
    /**
     * カテゴリ一覧表示
     * 
     * @return string|ResponseInterface
     */
    public function index()
    {
        $data = [
            'title' => 'カテゴリ一覧',
            'pagetitle' => 'カテゴリ管理',
        ];

        return view('admin/category/list', $data);
    }

    /**
     * カテゴリ新規作成フォーム表示
     * 
     * @return string|ResponseInterface
     */
    public function new()
    {
        $data = [
            'title' => 'カテゴリ作成',
            'pagetitle' => 'カテゴリ管理',
        ];

        return view('admin/category/create', $data);
    }

    /**
     * カテゴリ作成処理
     * 
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        // TODO: 実装
        return $this->response->redirect(site_url('/admin/categories'));
    }

    /**
     * カテゴリ編集フォーム表示
     * 
     * @param int $id カテゴリID
     * @return string|ResponseInterface
     */
    public function edit($id = null)
    {
        $data = [
            'title' => 'カテゴリ編集',
            'pagetitle' => 'カテゴリ管理',
            'id' => $id,
        ];

        return view('admin/category/edit', $data);
    }

    /**
     * カテゴリ更新処理
     * 
     * @param int $id カテゴリID
     * @return RedirectResponse
     */
    public function update($id = null): RedirectResponse
    {
        // TODO: 実装
        return $this->response->redirect(site_url('/admin/categories/' . $id));
    }

    /**
     * カテゴリ削除処理
     * 
     * @param int $id カテゴリID
     * @return RedirectResponse
     */
    public function delete($id = null): RedirectResponse
    {
        // TODO: 実装
        return $this->response->redirect(site_url('/admin/categories'));
    }
}
