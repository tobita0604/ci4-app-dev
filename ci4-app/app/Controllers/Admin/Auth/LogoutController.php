<?php

namespace App\Controllers\Admin\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

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
     * @return ResponseInterface
     */
    public function index()
    {
        // セッション情報をクリア
        session()->remove('admin_logged_in');
        session()->remove('charger_id');
        session()->remove('charger_name');
        session()->remove('charger_type');
        
        // セッション全体を破棄
        session()->destroy();

        return redirect()->to('/admin/login')->with('success', 'ログアウトしました');
    }
}
