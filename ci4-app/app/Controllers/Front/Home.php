<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * フロントページ ホームコントローラー
 * 
 * フロントサイトのトップページを表示します。
 */
class Home extends BaseController
{
    /**
     * トップページ表示
     * 
     * @return string|ResponseInterface
     */
    public function index()
    {
        $data = [
            'title' => 'ホーム',
        ];

        return view('front/home/index', $data);
    }
}
