<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * オプション利用可能期間テーブルのマイグレーション
 * 
 * オプションツアーの利用可能日と期間の管理
 */
class CreateOptionAvailableTable extends Migration
{
    /**
     * マイグレーション実行
     */
    public function up()
    {
        $this->forge->addField([
            'type' => [
                'type'    => 'INT',
                'comment' => 'オプション種別'
            ],
            'day' => [
                'type'    => 'INT',
                'comment' => '日付（1=1日目, 2=2日目, 3=3日目）'
            ],
            'period' => [
                'type'    => 'INT',
                'comment' => '時間帯（1=午前, 2=午後）'
            ],
            'option_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'comment'    => 'オプションID'
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
        
        $this->forge->addKey(['type', 'day', 'period', 'option_id'], true);
        $this->forge->createTable('option_availables', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('option_availables', true);
    }
}
