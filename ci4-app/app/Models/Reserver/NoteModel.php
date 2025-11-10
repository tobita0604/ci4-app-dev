<?php

namespace App\Models\Reserver;

use CodeIgniter\Model;

/**
 * 備考・メモモデル
 * 
 * r01_noteテーブルへのアクセスを提供します。
 * 予約者に関連する備考・メモ情報を管理します。
 */
class NoteModel extends Model
{
    /**
     * @var string テーブル名
     */
    protected $table = 'r01_note';

    /**
     * @var string 主キー
     */
    protected $primaryKey = 'R01_Note_Id';

    /**
     * @var bool 自動インクリメント使用
     */
    protected $useAutoIncrement = true;

    /**
     * @var string 戻り値の型
     */
    protected $returnType = 'array';

    /**
     * @var bool ソフトデリート使用
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool タイムスタンプ使用
     */
    protected $useTimestamps = false;

    /**
     * @var array 許可するフィールド
     */
    protected $allowedFields = [
        'R01_User_Id',
        'R01_Note_Text',
        'R01_Note_Date',
    ];

    /**
     * @var array バリデーションルール
     */
    protected $validationRules = [
        'R01_User_Id' => 'required|max_length[20]',
        'R01_Note_Text' => 'required',
    ];

    /**
     * @var array バリデーションメッセージ
     */
    protected $validationMessages = [
        'R01_User_Id' => [
            'required' => 'ユーザーIDは必須です',
        ],
        'R01_Note_Text' => [
            'required' => 'メモ内容は必須です',
        ],
    ];

    /**
     * 特定の予約者のメモ一覧を取得
     * 
     * @param string $userId ユーザーID
     * @return array
     */
    public function getNotesByUserId(string $userId): array
    {
        return $this->where('R01_User_Id', $userId)
                    ->orderBy('R01_Note_Date', 'DESC')
                    ->findAll();
    }

    /**
     * 新しいメモを追加
     * 
     * @param string $userId ユーザーID
     * @param string $noteText メモ内容
     * @return int|bool 挿入されたID、または失敗時false
     */
    public function addNote(string $userId, string $noteText)
    {
        return $this->insert([
            'R01_User_Id' => $userId,
            'R01_Note_Text' => $noteText,
            'R01_Note_Date' => date('Y-m-d H:i:s'),
        ]);
    }
}
