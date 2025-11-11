<?php

namespace App\Controllers\Front\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * フロント会員登録コントローラー
 * 
 * フロントサイトでの新規会員登録機能を提供します。
 */
class RegisterController extends BaseController
{
    /**
     * 会員登録フォーム表示
     * 
     * @return string|ResponseInterface
     */
    public function index()
    {
        $data = [
            'title' => '会員登録',
        ];

        return view('front/auth/register', $data);
    }

    /**
     * 会員登録処理
     * 
     * @return RedirectResponse
     */
    public function register(): RedirectResponse
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'name' => 'required|max_length[100]',
            'email' => 'required|valid_email|is_unique[r01_member.R01_Email]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->redirect(previous_url())
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // TODO: 会員登録処理実装

        return $this->response->redirect(site_url('/auth/register/complete'))
            ->with('success', '会員登録が完了しました');
    }

    /**
     * 会員登録完了画面
     * 
     * @return string|ResponseInterface
     */
    public function complete()
    {
        $data = [
            'title' => '会員登録完了',
        ];

        return view('front/auth/register_complete', $data);
    }
}
