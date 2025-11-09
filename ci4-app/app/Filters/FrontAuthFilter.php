<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * フロント画面認証フィルター
 * 
 * フロント画面の会員限定エリアへのアクセスを制御
 */
class FrontAuthFilter implements FilterInterface
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
        
        // セッションにユーザーログイン情報が存在するかチェック
        if (!$session->get('user_logged_in')) {
            // ログインページ以外からのアクセスの場合、リダイレクト先を保存
            $currentPath = $request->getUri()->getPath();
            if ($currentPath !== '/login') {
                $session->set('redirect_url', $currentPath);
            }
            
            return redirect()->to('/login');
        }

        // アカウント有効状態チェック
        if (!$session->get('user_is_active')) {
            $session->destroy();
            return redirect()->to('/login')
                           ->with('error', 'アカウントが無効化されています');
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
