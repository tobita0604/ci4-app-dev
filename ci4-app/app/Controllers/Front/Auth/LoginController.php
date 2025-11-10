<?php

namespace App\Controllers\Front\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * フロント会員ログインコントローラー
 * 
 * フロントサイトでの会員ログイン機能を提供します。
 */
class LoginController extends BaseController
{
    /**
     * ログインフォーム表示
     * 
     * @return string|ResponseInterface
     */
    public function index()
    {
        // 既にログイン済みの場合はマイページへリダイレクト
        if (session()->get('member_logged_in')) {
            return redirect()->to('/mypage');
        }

        $data = [
            'title' => 'ログイン',
        ];

        return view('front/auth/login', $data);
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
            'email' => 'required|valid_email',
            'password' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // TODO: 会員認証処理実装

        // 仮の実装
        session()->set([
            'member_logged_in' => true,
            'member_email' => $email,
        ]);

        return redirect()->to('/mypage')->with('success', 'ログインしました');
    }

    /**
     * ログアウト処理
     * 
     * @return ResponseInterface
     */
    public function logout()
    {
        session()->remove('member_logged_in');
        session()->remove('member_email');
        session()->remove('member_id');
        
        return redirect()->to('/')->with('success', 'ログアウトしました');
    }
}
