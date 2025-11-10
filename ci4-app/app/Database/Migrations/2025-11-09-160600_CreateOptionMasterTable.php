<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * オプションマスタテーブルのマイグレーション
 * 
 * オプションツアーの基本情報（料金、営業時間、催行時間など）
 */
class CreateOptionMasterTable extends Migration
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
            'option_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'comment'    => 'オプションID'
            ],
            'option_id_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null'       => true,
                'comment'    => 'オプションID名称'
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'ツアー名'
            ],
            'price_adult' => [
                'type'    => 'INT',
                'default' => 0,
                'comment' => '大人単価'
            ],
            'price_child' => [
                'type'    => 'INT',
                'default' => 0,
                'comment' => '子供単価'
            ],
            'business_time' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => '営業時間'
            ],
            // 1日目の催行情報
            'day1_on' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '1日目受付可否: 0=不可, 1=受付可'
            ],
            'day1_time' => [
                'type'       => 'TEXT',
                'null'       => true,
                'comment'    => '1日目催行時間（カンマ区切り）'
            ],
            // 2日目の催行情報
            'day2_on' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '2日目受付可否: 0=不可, 1=受付可'
            ],
            'day2_time' => [
                'type'       => 'TEXT',
                'null'       => true,
                'comment'    => '2日目催行時間（カンマ区切り）'
            ],
            // 3日目の催行情報
            'day3_on' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '3日目受付可否: 0=不可, 1=受付可'
            ],
            'day3_time' => [
                'type'       => 'TEXT',
                'null'       => true,
                'comment'    => '3日目催行時間（カンマ区切り）'
            ],
            'is_golf' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'ゴルフフラグ: 0=その他, 1=ゴルフ'
            ],
            'sort_order' => [
                'type'    => 'INT',
                'default' => 0,
                'comment' => '表示順'
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
        
        $this->forge->addKey(['type', 'option_id'], true);
        $this->forge->createTable('option_masters', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('option_masters', true);
    }
}
