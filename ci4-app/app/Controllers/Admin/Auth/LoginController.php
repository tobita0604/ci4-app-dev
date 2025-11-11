<?php

namespace App\Controllers\Admin\Auth;

use App\Controllers\BaseController;
use App\Services\Auth\AuthService;
use CodeIgniter\HTTP\RedirectResponse;
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
     * @return string|RedirectResponse
     */
    public function index(): string|RedirectResponse
    {
        // 既にログイン済みの場合はダッシュボードへリダイレクト
        if ($this->authService->isChargerLoggedIn()) {
            return $this->response->redirect(site_url('admin/dashboard'));
        }

        $data = [
            'title' => '管理画面ログイン',
        ];

        return view('admin/auth/login', $data);
    }

    /**
     * ログイン処理
     * 
     * @return RedirectResponse
     */
    public function login(): RedirectResponse
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'charger_id' => 'required',
            'password' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->redirect(previous_url())
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $chargerId = $this->request->getPost('charger_id');
        $password = $this->request->getPost('password');

        // AuthServiceで認証処理
        if (!$this->authService->chargerLogin($chargerId, $password)) {
            return $this->response->redirect(previous_url())
                ->withInput()
                ->with('error', '担当者IDまたはパスワードが正しくありません');
        }

        // リダイレクト先URLがセッションに保存されていれば、そこへリダイレクト
        $redirectUrl = session()->get('redirect_url') ?? site_url('admin/dashboard');
        session()->remove('redirect_url');

        return $this->response->redirect($redirectUrl)
            ->with('success', 'ログインしました');
    }
}
