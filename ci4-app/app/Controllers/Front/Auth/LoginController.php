<?php

namespace App\Controllers\Front\Auth;

use App\Controllers\BaseController;
use App\Services\Auth\AuthService;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * フロント会員ログインコントローラー
 * 
 * フロントサイトでの会員ログイン機能を提供します。
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
        helper(['url', 'form']);
        $this->authService = new AuthService();
    }

    /**
     * ログインフォーム表示
     * 
     * @return string|RedirectResponse
     */
    public function index(): string|RedirectResponse
    {
        // 既にログイン済みの場合はマイページへリダイレクト
        if ($this->authService->isReserverLoggedIn()) {
            return $this->response->redirect(site_url('mypage'));
        }

        $data = [
            'title' => 'ログイン',
        ];

        return view('front/auth/login', $data);
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
            'reserver_id' => 'required',
            'password' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->redirect(previous_url())
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $reserverId = $this->request->getPost('reserver_id');
        $password = $this->request->getPost('password');

        // AuthServiceで認証処理
        if (!$this->authService->reserverLogin($reserverId, $password)) {
            return $this->response->redirect(previous_url())
                ->withInput()
                ->with('error', '予約者IDまたはパスワードが正しくありません');
        }

        // リダイレクト先URLがセッションに保存されていれば、そこへリダイレクト
        $redirectUrl = session()->get('redirect_url') ?? site_url('mypage');
        session()->remove('redirect_url');

        return $this->response->redirect($redirectUrl)
            ->with('success', 'ログインしました');
    }

    /**
     * ログアウト処理
     * 
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        // AuthServiceでログアウト処理
        $this->authService->reserverLogout();
        
        return $this->response->redirect(site_url('/'))
            ->with('success', 'ログアウトしました');
    }
}
