<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * レンタカー予約テーブルのマイグレーション
 * 
 * レンタカー予約情報と運転免許証情報を管理
 */
class CreateCarRentalTable extends Migration
{
    /**
     * マイグレーション実行
     */
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'comment'    => 'ユーザーID（予約者ID）'
            ],
            'name_kanji' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'comment'    => '名前（漢字）'
            ],
            'name_kana' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'comment'    => '名前（カナ）'
            ],
            'driver_license_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'comment'    => '運転免許証番号'
            ],
            'driver_license_expiry' => [
                'type'    => 'DATE',
                'comment' => '運転免許証有効期限'
            ],
            'class' => [
                'type'       => 'VARCHAR',
                'constraint' => '2',
                'comment'    => 'レンタカークラス'
            ],
            'from_drive_date' => [
                'type'    => 'DATE',
                'comment' => '貸出日'
            ],
            'from_drive_time' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'comment'    => '貸出時間（HH:MM）'
            ],
            'to_drive_date' => [
                'type'    => 'DATE',
                'comment' => '返却日'
            ],
            'to_drive_time' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'comment'    => '返却時間（HH:MM）'
            ],
            'car_insurance' => [
                'type'       => 'VARCHAR',
                'constraint' => '6',
                'comment'    => '自動車保険'
            ],
            'child_seat' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'チャイルドシート: 0=不要, 1=必要'
            ],
            'regist_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '登録済みフラグ: 0=未登録, 1=登録済み'
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
        
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('car_rentals', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('car_rentals', true);
    }
}
