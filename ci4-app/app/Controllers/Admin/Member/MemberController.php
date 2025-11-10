<?php

namespace App\Controllers\Admin\Member;

use App\Controllers\BaseController;
use App\Services\Reservation\MemberService;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * 会員管理コントローラー
 * 
 * 管理画面での会員情報の一覧表示、編集機能を提供します。
 * ビジネスロジックはMemberServiceに委譲します。
 */
class MemberController extends BaseController
{
    /**
     * @var MemberService 会員関連サービス
     */
    protected MemberService $memberService;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        // TODO: MemberService実装後にインスタンス化
        // $this->memberService = new MemberService();
    }

    /**
     * 会員一覧表示
     * 
     * @return string|ResponseInterface
     */
    public function index()
    {
        $data = [
            'title' => '会員一覧',
            'members' => [], // TODO: サービス層から取得
        ];

        return view('admin/member/list', $data);
    }

    /**
     * 会員編集フォーム表示
     * 
     * @param int $id 会員ID
     * @return string|ResponseInterface
     */
    public function edit($id)
    {
        $data = [
            'title' => '会員編集',
            'member' => [], // TODO: サービス層から取得
        ];

        return view('admin/member/edit', $data);
    }

    /**
     * 会員情報更新
     * 
     * @param int $id 会員ID
     * @return ResponseInterface
     */
    public function update($id)
    {
        // TODO: 実装
        return redirect()->to('/admin/member');
    }
}
