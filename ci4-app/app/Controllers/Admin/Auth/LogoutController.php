<?php

namespace App\Controllers\Admin\Auth;

use App\Controllers\BaseController;
use App\Services\Auth\AuthService;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * 管理画面ログアウトコントローラー
 * 
 * 管理画面からのログアウト処理を提供します。
 */
class LogoutController extends BaseController
{
    /**
     * @var AuthService 認証関連サービス
     */
    protected AuthService $authService;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * ログアウト処理
     * 
     * セッションを破棄し、ログイン画面へリダイレクトします。
     * 
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        // AuthServiceでログアウト処理
        $this->authService->chargerLogout();

        return $this->response->redirect(site_url('admin/auth/login'))
            ->with('success', 'ログアウトしました');
    }
}
