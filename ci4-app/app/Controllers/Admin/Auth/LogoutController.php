<?php

namespace App\Controllers\Admin\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * 管理画面ログアウトコントローラー
 * 
 * 管理画面からのログアウト処理を提供します。
 */
class LogoutController extends BaseController
{
    /**
     * ログアウト処理
     * 
     * セッションを破棄し、ログイン画面へリダイレクトします。
     * 
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        // セッション情報をクリア
        session()->remove('admin_logged_in');
        session()->remove('charger_id');
        session()->remove('charger_name');
        session()->remove('charger_type');
        
        // セッション全体を破棄
        session()->destroy();

        return $this->response->redirect(site_url('/admin/login'))
            ->with('success', 'ログアウトしました');
    }
}
