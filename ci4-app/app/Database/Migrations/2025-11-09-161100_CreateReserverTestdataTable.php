<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * テストデータ予約者テーブルのマイグレーション
 * 
 * テスト用予約者データの管理（本番データと分離）
 */
class CreateReserverTestdataTable extends Migration
{
    /**
     * マイグレーション実行
     */
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'comment'    => '予約者ID（テスト用）'
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'comment'    => 'パスワード'
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
            'test_type' => [
                'type'    => 'TINYINT',
                'default' => 1,
                'comment' => 'テスト種別: 1=通常テスト, 9=nssテスト'
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
        $this->forge->createTable('reserver_testdata', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('reserver_testdata', true);
    }
}
