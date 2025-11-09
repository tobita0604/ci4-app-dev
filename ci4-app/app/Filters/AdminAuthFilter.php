<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * 管理画面認証フィルター
 * 
 * 管理画面へのアクセスを制御し、未認証ユーザーをログイン画面にリダイレクト
 */
class AdminAuthFilter implements FilterInterface
{
    /**
     * リクエスト前処理
     * 
     * @param RequestInterface $request
     * @param array|null $arguments
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // セッションに管理者ログイン情報が存在するかチェック
        if (!$session->get('admin_logged_in')) {
            // ログインページ以外からのアクセスの場合、リダイレクト先を保存
            $currentPath = $request->getUri()->getPath();
            if ($currentPath !== '/admin/login') {
                $session->set('redirect_url', $currentPath);
            }
            
            return redirect()->to('/admin/login');
        }

        // 管理者権限チェック（オプション）
        $userRole = $session->get('admin_role');
        if ($userRole !== 'admin') {
            return redirect()->to('/admin/login')
                           ->with('error', '管理者権限が必要です');
        }
    }

    /**
     * レスポンス後処理
     * 
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 必要に応じてレスポンス後の処理を実装
    }
}
