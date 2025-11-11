<?php

namespace App\Controllers\Front\Auth;

use App\Controllers\BaseController;
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
     * コンストラクタ
     */
    public function __construct()
    {
        helper(['url', 'form']);
    }

    /**
     * ログインフォーム表示
     * 
     * @return string|RedirectResponse
     */
    public function index(): string|RedirectResponse
    {
        // 既にログイン済みの場合はマイページへリダイレクト
        if (session()->get('member_logged_in')) {
            return $this->response->redirect(site_url('/mypage'));
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
            'email' => 'required|valid_email',
            'password' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->redirect(previous_url())
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // TODO: 会員認証処理実装

        // 仮の実装
        session()->set([
            'member_logged_in' => true,
            'member_email' => $email,
        ]);

        return $this->response->redirect(site_url('/mypage'))
            ->with('success', 'ログインしました');
    }

    /**
     * ログアウト処理
     * 
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        session()->remove('member_logged_in');
        session()->remove('member_email');
        session()->remove('member_id');
        
        return $this->response->redirect(site_url('/'))
            ->with('success', 'ログアウトしました');
    }
}
