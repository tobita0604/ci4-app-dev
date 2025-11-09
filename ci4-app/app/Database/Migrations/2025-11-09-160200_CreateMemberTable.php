<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * メンバーテーブルのマイグレーション
 * 
 * 旅行参加メンバーの詳細情報（パスポート、ESTA、緊急連絡先など）
 */
class CreateMemberTable extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'comment'    => '氏名（フルネーム）'
            ],
            'name_last' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'comment'    => '姓（漢字）'
            ],
            'name_first' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'comment'    => '名（漢字）'
            ],
            'roma_last' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'comment'    => '姓（ローマ字）'
            ],
            'roma_first' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'comment'    => '名（ローマ字）'
            ],
            'birthdate' => [
                'type'    => 'DATE',
                'comment' => '生年月日'
            ],
            'age' => [
                'type'    => 'INT',
                'null'    => true,
                'comment' => '年齢'
            ],
            'gender' => [
                'type'    => 'TINYINT',
                'null'    => true,
                'comment' => '性別: 0=女性, 1=男性'
            ],
            'relationship' => [
                'type'    => 'TINYINT',
                'null'    => true,
                'comment' => '続柄'
            ],
            'mobile_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'comment'    => '携帯電話番号'
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'メールアドレス'
            ],
            'passport_flg' => [
                'type'    => 'TINYINT',
                'null'    => true,
                'comment' => 'パスポート有無フラグ'
            ],
            'passport_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'comment'    => 'パスポート番号'
            ],
            'passport_issue_date' => [
                'type'    => 'DATE',
                'null'    => true,
                'comment' => 'パスポート発行日'
            ],
            'passport_valid_date' => [
                'type'    => 'DATE',
                'null'    => true,
                'comment' => 'パスポート有効期限'
            ],
            'passport_img' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
                'comment'    => 'パスポート画像ファイル名'
            ],
            'passport_date' => [
                'type'    => 'DATE',
                'null'    => true,
                'comment' => 'パスポート登録日'
            ],
            'esta_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'ESTA取得フラグ'
            ],
            'nationality' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'comment'    => '国籍'
            ],
            'postal1' => [
                'type'       => 'VARCHAR',
                'constraint' => '3',
                'comment'    => '郵便番号（前半）'
            ],
            'postal2' => [
                'type'       => 'VARCHAR',
                'constraint' => '4',
                'comment'    => '郵便番号（後半）'
            ],
            'prefecture' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'comment'    => '都道府県'
            ],
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => '市区町村'
            ],
            'address2' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => '町村名番地番号'
            ],
            'address3' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
                'comment'    => '建物名・部屋番号等'
            ],
            'tel_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'comment'    => '電話番号'
            ],
            'emer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => '緊急連絡先氏名'
            ],
            'emer_relationship' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => '緊急連絡先続柄'
            ],
            'emer_tel_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'comment'    => '緊急連絡先電話番号'
            ],
            // ベビー・幼児オプション
            'baby_meal' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'ベビーミール'
            ],
            'baby_bassinet' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'バシネット'
            ],
            'baby_height' => [
                'type'    => 'INT',
                'default' => 0,
                'comment' => '身長（cm）'
            ],
            'baby_weight' => [
                'type'    => 'INT',
                'default' => 0,
                'comment' => '体重（kg）'
            ],
            'baby_chair' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'ベビーチェア'
            ],
            'baby_bed' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'ベビーベッド'
            ],
            'baby_bed2' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'ベビーベッド2'
            ],
            'baby_car' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'ベビーカー'
            ],
            'infant_bed' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '幼児用ベッド'
            ],
            'infant_party' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '幼児パーティ参加'
            ],
            'infant_meal' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '幼児食'
            ],
            'infant_chair' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '幼児用チェア'
            ],
            'infant_bassinet' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '幼児用バシネット'
            ],
            'entry_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '登録完了フラグ'
            ],
            'cancel_flg' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => 'キャンセルフラグ'
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
        $this->forge->createTable('members', true);
    }

    /**
     * マイグレーションロールバック
     */
    public function down()
    {
        $this->forge->dropTable('members', true);
    }
}
