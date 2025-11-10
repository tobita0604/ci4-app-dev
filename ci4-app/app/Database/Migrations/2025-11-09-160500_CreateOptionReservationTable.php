<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * オプションツアー予約テーブルのマイグレーション
 * 
 * ファーム見学、ゴルフ、その他オプションツアーの予約情報を管理
 */
class CreateOptionReservationTable extends Migration
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
            'seq' => [
                'type'    => 'INT',
                'comment' => 'メンバー連番'
            ],
            'park_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'パークフラグ'
            ],
            // ファーム見学
            'farm_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'ファーム見学フラグ'
            ],
            'farm_tour' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'comment'    => 'ファームツアー種別'
            ],
            'farm_time' => [
                'type'    => 'INT',
                'default' => 0,
                'comment' => 'ファームツアー時間ID'
            ],
            'farm_flg2' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'ファーム見学フラグ2'
            ],
            'farm_tour2' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'comment'    => 'ファームツアー種別2'
            ],
            'farm_time2' => [
                'type'    => 'INT',
                'default' => 0,
                'comment' => 'ファームツアー時間ID2'
            ],
            // ゴルフ
            'golf_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'ゴルフフラグ'
            ],
            'golf_club' => [
                'type'    => 'INT',
                'default' => 0,
                'comment' => 'ゴルフクラブ貸出'
            ],
            'golf_shoes' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,1',
                'default'    => 0,
                'comment'    => 'ゴルフシューズサイズ'
            ],
            'golf_biko' => [
                'type'    => 'TEXT',
                'null'    => true,
                'comment' => 'ゴルフ備考'
            ],
            // オプションツアー（日別・時間帯別）
            'option1' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'comment'    => '1日目午前オプション'
            ],
            'option2' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'comment'    => '1日目午後オプション'
            ],
            'option3' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'comment'    => '2日目午前オプション'
            ],
            'option4' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'comment'    => '2日目午後オプション'
            ],
            'option5' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'comment'    => '3日目午前オプション'
            ],
            'option1_time' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
                'comment'    => 'オプション1の時間'
            ],
            'option2_time' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
                'comment'    => 'オプション2の時間'
            ],
            'price' => [
                'type'    => 'INT',
                'default' => 0,
                'comment' => '代金'
            ],
            'option_type' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'オプション種別: 0=未選択, 1=無料招待, 2=自費参加'
            ],
            // バス・レンタカー選択
            'bus_dep' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '往路: 0=未設定, 1=シャトルバス, 2=レンタカー'
            ],
            'bus_arr' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '復路: 0=未設定, 1=シャトルバス, 2=レンタカー'
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
        
        $this->forge->addKey(['reserver_id', 'seq'], true);
        $this->forge->createTable('option_reservations', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('option_reservations', true);
    }
}
