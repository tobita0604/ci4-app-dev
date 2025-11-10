<?php

namespace App\Controllers\Admin\Auth;

use App\Controllers\BaseController;
use App\Services\Auth\AuthService;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * 管理画面ログインコントローラー
 * 
 * 管理画面へのログイン処理を提供します。
 * IPアドレス制限、認証処理はAuthServiceに委譲します。
 */
class LoginController extends BaseController
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
     * ログインフォーム表示
     * 
     * @return string|ResponseInterface
     */
    public function index()
    {
        // 既にログイン済みの場合はダッシュボードへリダイレクト
        if (session()->get('admin_logged_in')) {
            return redirect()->to('/admin');
        }

        $data = [
            'title' => '管理画面ログイン',
        ];

        return view('admin/auth/login', $data);
    }

    /**
     * ログイン処理
     * 
     * @return ResponseInterface
     */
    public function login()
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'charger_id' => 'required',
            'password' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $chargerId = $this->request->getPost('charger_id');
        $password = $this->request->getPost('password');

        // TODO: AuthServiceでの認証処理実装
        // $result = $this->authService->authenticate($chargerId, $password);

        // 仮の実装
        session()->set([
            'admin_logged_in' => true,
            'charger_id' => $chargerId,
        ]);

        return redirect()->to('/admin')->with('success', 'ログインしました');
    }
}
