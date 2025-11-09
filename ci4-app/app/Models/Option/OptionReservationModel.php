<?php

namespace App\Models\Option;

use CodeIgniter\Model;

/**
 * オプション予約モデル
 * 
 * メンバーごとのオプションツアー予約情報を管理
 * 
 * @package App\Models\Option
 */
class OptionReservationModel extends Model
{
    /**
     * テーブル名
     * 
     * @var string
     */
    protected $table = 'option_reservations';

    /**
     * 主キー（複合キー）
     * 
     * @var array
     */
    protected $primaryKey = ['reserver_id', 'seq'];

    /**
     * 自動インクリメント使用フラグ
     * 
     * @var bool
     */
    protected $useAutoIncrement = false;

    /**
     * 戻り値の型
     * 
     * @var string
     */
    protected $returnType = 'array';

    /**
     * 許可されたフィールド
     * 
     * @var array
     */
    protected $allowedFields = [
        'reserver_id',
        'seq',
        'park_flg',
        'farm_flg',
        'farm_tour',
        'farm_time',
        'farm_flg2',
        'farm_tour2',
        'farm_time2',
        'golf_flg',
        'golf_club',
        'golf_shoes',
        'golf_biko',
        'option1',
        'option2',
        'option3',
        'option4',
        'option5',
        'option1_time',
        'option2_time',
        'price',
        'option_type',
        'bus_dep',
        'bus_arr'
    ];

    /**
     * タイムスタンプ使用フラグ
     * 
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * オプション種別定数
     */
    public const TYPE_UNSELECTED = 0;  // 未選択
    public const TYPE_FREE = 1;        // 無料招待
    public const TYPE_PAID = 2;        // 自費参加

    /**
     * バス・レンタカー選択定数
     */
    public const TRANSPORT_UNSET = 0;      // 未設定
    public const TRANSPORT_SHUTTLE = 1;    // シャトルバス
    public const TRANSPORT_RENTAL = 2;     // レンタカー

    /**
     * 予約者IDで予約一覧を取得
     * 
     * @param string $reserverId 予約者ID
     * @return array 予約一覧
     */
    public function getByReserver(string $reserverId): array
    {
        return $this->where('reserver_id', $reserverId)
                    ->orderBy('seq', 'ASC')
                    ->findAll();
    }

    /**
     * ゴルフ予約一覧を取得
     * 
     * @return array ゴルフ予約一覧
     */
    public function getGolfReservations(): array
    {
        return $this->where('golf_flg', 1)
                    ->orderBy('reserver_id', 'ASC')
                    ->orderBy('seq', 'ASC')
                    ->findAll();
    }

    /**
     * オプション種別名を取得
     * 
     * @param int $type オプション種別
     * @return string オプション種別名
     */
    public static function getTypeName(int $type): string
    {
        return match($type) {
            self::TYPE_UNSELECTED => '未選択',
            self::TYPE_FREE => '無料招待',
            self::TYPE_PAID => '自費参加',
            default => '不明'
        };
    }

    /**
     * 交通手段名を取得
     * 
     * @param int $transport 交通手段
     * @return string 交通手段名
     */
    public static function getTransportName(int $transport): string
    {
        return match($transport) {
            self::TRANSPORT_UNSET => '未設定',
            self::TRANSPORT_SHUTTLE => 'シャトルバス',
            self::TRANSPORT_RENTAL => 'レンタカー',
            default => '不明'
        };
    }
}
