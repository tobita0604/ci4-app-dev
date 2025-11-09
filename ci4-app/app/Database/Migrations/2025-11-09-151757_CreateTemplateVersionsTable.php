<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * テンプレートバージョンテーブルのマイグレーション
 * 
 * テンプレートの変更履歴を管理し、復元機能を提供
 */
class CreateTemplateVersionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'template_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'version_number' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'content' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'variables' => [
                'type'    => 'JSON',
                'null'    => true,
                'comment' => 'このバージョンでのテンプレート変数',
            ],
            'change_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['template_id', 'version_number']);
        $this->forge->addForeignKey('template_id', 'templates', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('template_versions');
    }

    public function down()
    {
        $this->forge->dropTable('template_versions');
    }
}
