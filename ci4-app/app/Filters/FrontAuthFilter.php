<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\Auth\AuthService;

/**
 * フロント画面認証フィルター
 * 
 * フロント画面の予約者限定エリアへのアクセスを制御
 * 未認証ユーザーをログイン画面にリダイレクト
 * 
 * @package App\Filters
 */
class FrontAuthFilter implements FilterInterface
{
    /**
     * 認証サービス
     * 
     * @var AuthService
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
     * リクエスト前処理
     * 
     * 予約者認証をチェックし、未認証の場合はログイン画面へリダイレクト
     * 
     * @param RequestInterface $request リクエストオブジェクト
     * @param array|null $arguments フィルター引数
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // 予約者認証チェック
        if (!$this->authService->isReserverLoggedIn()) {
            $session = session();
            
            // ログインページ以外からのアクセスの場合、リダイレクト先を保存
            $currentPath = $request->getUri()->getPath();
            if ($currentPath !== '/login' && $currentPath !== '/logout') {
                $session->set('redirect_url', $currentPath);
            }
            
            return redirect()->to('/login')
                           ->with('error', 'ログインが必要です');
        }

        // リクエストに予約者情報を付与（コントローラーで利用可能）
        $request->reserverData = $this->authService->getReserverData();
    }

    /**
     * レスポンス後処理
     * 
     * @param RequestInterface $request リクエストオブジェクト
     * @param ResponseInterface $response レスポンスオブジェクト
     * @param array|null $arguments フィルター引数
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // セキュリティヘッダーを追加
        $response->setHeader('X-Content-Type-Options', 'nosniff');
        $response->setHeader('X-XSS-Protection', '1; mode=block');
        
        return $response;
    }
}
