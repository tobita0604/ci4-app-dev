<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * 予約者テーブルのマイグレーション
 * 
 * 旅行予約者の基本情報、ログイン情報、招待枠管理
 */
class CreateReserverTable extends Migration
{
    /**
     * マイグレーション実行
     */
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '15',
                'comment'        => '予約者ID（ログインID）'
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'comment'    => 'パスワード（ハッシュ化）'
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'comment'    => '予約コード'
            ],
            'category_flg' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'comment'    => 'カテゴリフラグ'
            ],
            'q1_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '1Q家族招待CP 結果'
            ],
            'q4_flg' => [
                'type'       => 'VARCHAR',
                'constraint' => '1',
                'null'       => true,
                'comment'    => '4Q家族招待CP 状況'
            ],
            'park_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'パークフラグ'
            ],
            'free_invites' => [
                'type'    => 'INT',
                'default' => 0,
                'comment' => '無料招待枠'
            ],
            'charge_invites' => [
                'type'    => 'INT',
                'default' => 0,
                'comment' => '有料招待枠'
            ],
            'branch_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'comment'    => '支社コード'
            ],
            'branch_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => '支社名'
            ],
            'branch_sort' => [
                'type'    => 'INT',
                'default' => 0,
                'comment' => 'ソート番号'
            ],
            'brochure_img' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
                'comment'    => 'パンフレット画像'
            ],
            'note' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null'       => true,
                'comment'    => '備考'
            ],
            'login_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'ログインフラグ: 0=未ログイン, 1=ログイン済み'
            ],
            'first_login_date' => [
                'type' => 'DATETIME',
                'null' => true,
                'comment' => '初回ログイン日時'
            ],
            'last_login_date' => [
                'type' => 'DATETIME',
                'null' => true,
                'comment' => '最終ログイン日時'
            ],
            'update_date' => [
                'type' => 'DATETIME',
                'null' => true,
                'comment' => '更新日時'
            ],
            'update_user' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null'       => true,
                'comment'    => '更新者'
            ],
            'invoice_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '請求書フラグ'
            ],
            'dinner_hotel_flg' => [
                'type'    => 'TINYINT',
                'null'    => true,
                'comment' => 'ディナーホテルフラグ'
            ],
            'car_rental' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'レンタカーフラグ'
            ],
            'q4' => [
                'type'    => 'INT',
                'null'    => true,
                'comment' => '4Q利用: 0=OP, 1=自費補助'
            ],
            'go_flight' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
                'comment'    => '往路便名'
            ],
            'go_ticket' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
                'comment'    => '往路チケット'
            ],
            'all_cancel' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '全キャンセルフラグ'
            ],
            'test_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'テストフラグ: 0=通常, 1=テスト用, 9=nssテスト用'
            ],
            'reentry' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '再入力可否: 0=通常, 1=締切後入力可能'
            ],
            'seqno' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'comment'        => 'シーケンス番号'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addKey('seqno');
        $this->forge->createTable('reservers', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('reservers', true);
    }
}
