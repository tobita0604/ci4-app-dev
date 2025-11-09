<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * 担当者テーブルのマイグレーション
 * 
 * 営業担当者、オーガナイザー、管理者（KNT）の情報を管理
 */
class CreateChargerTable extends Migration
{
    /**
     * マイグレーション実行
     */
    public function up()
    {
        $this->forge->addField([
            'charger_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'comment'    => '担当者ID'
            ],
            'charger_password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'comment'    => 'パスワード（ハッシュ化）'
            ],
            'charger_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
                'comment'    => '担当者名'
            ],
            'charger_type' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
                'default'    => 0,
                'comment'    => '担当者種別: 0=営業担当者, 1=オーガナイザー, 9=管理者(KNT)'
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
        
        $this->forge->addKey('charger_id', true);
        $this->forge->createTable('chargers', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('chargers', true);
    }
}
