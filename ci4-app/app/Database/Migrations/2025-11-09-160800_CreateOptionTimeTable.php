<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * オプション時間別在庫テーブルのマイグレーション
 * 
 * オプションツアーの時間帯別在庫管理
 */
class CreateOptionTimeTable extends Migration
{
    /**
     * マイグレーション実行
     */
    public function up()
    {
        $this->forge->addField([
            'stock_id' => [
                'type'           => 'INT',
                'constraint'     => '3',
                'auto_increment' => true,
                'comment'        => '在庫ID'
            ],
            'option_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'comment'    => 'オプションID'
            ],
            'time_id' => [
                'type'       => 'INT',
                'constraint' => '2',
                'comment'    => '時間ID'
            ],
            'stock' => [
                'type'       => 'INT',
                'constraint' => '3',
                'default'    => 0,
                'comment'    => '在庫数'
            ],
            'reserve' => [
                'type'       => 'INT',
                'constraint' => '3',
                'default'    => 0,
                'comment'    => '予約数'
            ],
            'balance' => [
                'type'       => 'INT',
                'constraint' => '3',
                'default'    => 0,
                'comment'    => '残数（在庫 - 予約）'
            ],
            'date_flg' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
                'comment'    => '日付フラグ: 1=23日, 2=24日'
            ],
            'time_text' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'comment'    => '時間テキスト表示'
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
        
        $this->forge->addKey('stock_id', true);
        $this->forge->addKey(['option_id', 'time_id']);
        $this->forge->createTable('option_times', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('option_times', true);
    }
}
