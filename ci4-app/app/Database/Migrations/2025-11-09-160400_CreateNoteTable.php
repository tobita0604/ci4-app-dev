<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * 予約メモテーブルのマイグレーション
 * 
 * 予約に関する備考やメモを管理
 */
class CreateNoteTable extends Migration
{
    /**
     * マイグレーション実行
     */
    public function up()
    {
        $this->forge->addField([
            'reserver_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'comment'    => '予約者ID'
            ],
            'note' => [
                'type'       => 'TEXT',
                'constraint' => '2500',
                'null'       => true,
                'comment'    => '備考・メモ'
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
        
        $this->forge->addKey('reserver_id', true);
        $this->forge->createTable('notes', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('notes', true);
    }
}
