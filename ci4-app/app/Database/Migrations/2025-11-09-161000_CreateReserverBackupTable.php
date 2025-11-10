<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * 予約者バックアップテーブルのマイグレーション
 * 
 * 予約者情報の履歴・バックアップ管理
 */
class CreateReserverBackupTable extends Migration
{
    /**
     * マイグレーション実行
     */
    public function up()
    {
        $this->forge->addField([
            'backup_id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'comment'        => 'バックアップID'
            ],
            'backup_date' => [
                'type'    => 'DATETIME',
                'comment' => 'バックアップ日時'
            ],
            'backup_user' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'comment'    => 'バックアップ実行者'
            ],
            'reserver_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'comment'    => '予約者ID'
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
                'type'    => 'INT',
                'comment' => 'カテゴリフラグ'
            ],
            'q1_flg' => [
                'type'    => 'INT',
                'comment' => '1Q家族招待CP 結果'
            ],
            'q4_flg' => [
                'type'       => 'VARCHAR',
                'constraint' => '1',
                'null'       => true,
                'comment'    => '4Q家族招待CP 状況'
            ],
            'park_flg' => [
                'type'    => 'INT',
                'comment' => 'パークフラグ'
            ],
            'free_invites' => [
                'type'    => 'INT',
                'comment' => '無料招待枠'
            ],
            'charge_invites' => [
                'type'    => 'INT',
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
                'comment' => 'ソート番号'
            ],
            'note' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null'       => true,
                'comment'    => '備考'
            ],
            'login_flg' => [
                'type'    => 'INT',
                'comment' => 'ログインフラグ'
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
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('backup_id', true);
        $this->forge->addKey('reserver_id');
        $this->forge->addKey('backup_date');
        $this->forge->createTable('reserver_backups', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('reserver_backups', true);
    }
}
