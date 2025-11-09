<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\Auth\AuthService;
use App\Services\Auth\IpRestrictionService;

/**
 * 管理画面認証フィルター
 * 
 * 管理画面へのアクセスを制御し、IP制限と認証を実施
 * 未認証ユーザーをログイン画面にリダイレクト
 * 
 * @package App\Filters
 */
class AdminAuthFilter implements FilterInterface
{
    /**
     * 認証サービス
     * 
     * @var AuthService
     */
    protected AuthService $authService;

    /**
     * IP制限サービス
     * 
     * @var IpRestrictionService
     */
    protected IpRestrictionService $ipRestrictionService;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->authService = new AuthService();
        $this->ipRestrictionService = new IpRestrictionService();
    }

    /**
     * リクエスト前処理
     * 
     * IP制限と担当者認証をチェックし、未認証の場合はログイン画面へリダイレクト
     * 
     * @param RequestInterface $request リクエストオブジェクト
     * @param array|null $arguments フィルター引数
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // IP制限チェック
        if (!$this->ipRestrictionService->isAllowed()) {
            $currentIp = $this->ipRestrictionService->getCurrentIp();
            $currentPath = $request->getUri()->getPath();
            
            // アクセス拒否ログを記録
            $this->ipRestrictionService->logAccessDenied($currentIp, $currentPath);
            
            // 403 Forbiddenを返す
            return service('response')
                ->setStatusCode(403)
                ->setBody(view('errors/html/error_403', [
                    'message' => 'このIPアドレスからのアクセスは許可されていません。'
                ]));
        }

        // 担当者認証チェック
        if (!$this->authService->isChargerLoggedIn()) {
            $session = session();
            
            // ログインページ以外からのアクセスの場合、リダイレクト先を保存
            $currentPath = $request->getUri()->getPath();
            if ($currentPath !== '/admin/login' && $currentPath !== '/admin/logout') {
                $session->set('redirect_url', $currentPath);
            }
            
            return redirect()->to('/admin/login')
                           ->with('error', 'ログインが必要です');
        }

        // 管理者権限が必要な場合のチェック（オプション引数で指定可能）
        if (isset($arguments['role']) && $arguments['role'] === 'admin') {
            if (!$this->authService->isAdmin()) {
                return redirect()->to('/admin/dashboard')
                               ->with('error', '管理者権限が必要です');
            }
        }

        // リクエストに担当者情報を付与（コントローラーで利用可能）
        $request->chargerData = $this->authService->getChargerData();
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
        $response->setHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->setHeader('X-Content-Type-Options', 'nosniff');
        $response->setHeader('X-XSS-Protection', '1; mode=block');
        
        return $response;
    }
}
