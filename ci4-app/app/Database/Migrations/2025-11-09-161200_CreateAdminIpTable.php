<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * 管理者IP制限テーブルのマイグレーション
 * 
 * 管理画面へのアクセスを許可するIPアドレスの管理
 */
class CreateAdminIpTable extends Migration
{
    /**
     * マイグレーション実行
     */
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'comment'        => 'ID'
            ],
            'address_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'comment'    => 'アドレス名称（識別用）'
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
                'comment'    => 'IPアドレス（IPv4/IPv6対応）'
            ],
            'display_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '表示フラグ: 0=表示（有効）, 1=非表示（無効）'
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'comment' => '作成日時'
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'comment' => '更新日時'
            ],
            'deleted_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'comment' => '論理削除日時'
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addKey('ip_address');
        $this->forge->createTable('admin_ips', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('admin_ips', true);
    }
}
