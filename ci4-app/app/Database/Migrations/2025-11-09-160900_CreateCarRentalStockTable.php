<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * レンタカー在庫テーブルのマイグレーション
 * 
 * レンタカーのクラス別・日別在庫管理
 */
class CreateCarRentalStockTable extends Migration
{
    /**
     * マイグレーション実行
     */
    public function up()
    {
        $this->forge->addField([
            'class' => [
                'type'       => 'VARCHAR',
                'constraint' => '2',
                'comment'    => 'レンタカークラス'
            ],
            'rental_day' => [
                'type'       => 'INT',
                'constraint' => '2',
                'comment'    => 'レンタル日'
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
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => '1',
                'default'    => 0,
                'comment'    => '表示順'
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
        
        $this->forge->addKey(['class', 'rental_day'], true);
        $this->forge->createTable('car_rental_stocks', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('car_rental_stocks', true);
    }
}
