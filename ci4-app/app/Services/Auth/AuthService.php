<?php

namespace App\Services\Auth;

use App\Models\ChargerModel;
use App\Models\Reserver\ReserverModel;
use CodeIgniter\Session\Session;

/**
 * 認証サービス
 * 
 * 担当者および予約者の認証・セッション管理を行うサービス
 * 
 * @package App\Services\Auth
 */
class AuthService
{
    /**
     * セッション
     * 
     * @var Session
     */
    protected Session $session;

    /**
     * 担当者モデル
     * 
     * @var ChargerModel
     */
    protected ChargerModel $chargerModel;

    /**
     * 予約者モデル
     * 
     * @var ReserverModel
     */
    protected ReserverModel $reserverModel;

    /**
     * セッションキー定数
     */
    private const SESSION_CHARGER_KEY = 'charger_logged_in';
    private const SESSION_RESERVER_KEY = 'reserver_logged_in';
    private const SESSION_CHARGER_DATA = 'charger_data';
    private const SESSION_RESERVER_DATA = 'reserver_data';

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->session = session();
        $this->chargerModel = new ChargerModel();
        $this->reserverModel = new ReserverModel();
    }

    /**
     * 担当者ログイン
     * 
     * @param string $chargerId 担当者ID
     * @param string $password パスワード
     * @return bool ログイン成功フラグ
     */
    public function chargerLogin(string $chargerId, string $password): bool
    {
        $charger = $this->chargerModel->authenticate($chargerId, $password);

        if (!$charger) {
            return false;
        }

        // セッションに担当者情報を保存
        $this->session->set(self::SESSION_CHARGER_KEY, true);
        $this->session->set(self::SESSION_CHARGER_DATA, [
            'charger_id' => $charger['charger_id'],
            'charger_name' => $charger['charger_name'],
            'charger_type' => $charger['charger_type']
        ]);

        // セッション再生成（セキュリティ対策）
        $this->session->regenerate();

        return true;
    }

    /**
     * 予約者ログイン
     * 
     * @param string $reserverId 予約者ID
     * @param string $password パスワード
     * @return bool ログイン成功フラグ
     */
    public function reserverLogin(string $reserverId, string $password): bool
    {
        $reserver = $this->reserverModel->authenticate($reserverId, $password);

        if (!$reserver) {
            return false;
        }

        // 初回ログイン判定
        $isFirstLogin = empty($reserver['first_login_date']);

        // ログイン日時を更新
        $this->reserverModel->updateLoginDate($reserverId, $isFirstLogin);

        // セッションに予約者情報を保存
        $this->session->set(self::SESSION_RESERVER_KEY, true);
        $this->session->set(self::SESSION_RESERVER_DATA, [
            'reserver_id' => $reserver['id'],
            'code' => $reserver['code'],
            'branch_name' => $reserver['branch_name'],
            'free_invites' => $reserver['free_invites'],
            'charge_invites' => $reserver['charge_invites']
        ]);

        // セッション再生成（セキュリティ対策）
        $this->session->regenerate();

        return true;
    }

    /**
     * 担当者ログアウト
     * 
     * @return void
     */
    public function chargerLogout(): void
    {
        $this->session->remove(self::SESSION_CHARGER_KEY);
        $this->session->remove(self::SESSION_CHARGER_DATA);
        $this->session->destroy();
    }

    /**
     * 予約者ログアウト
     * 
     * @return void
     */
    public function reserverLogout(): void
    {
        $this->session->remove(self::SESSION_RESERVER_KEY);
        $this->session->remove(self::SESSION_RESERVER_DATA);
        $this->session->destroy();
    }

    /**
     * 担当者がログイン中かチェック
     * 
     * @return bool ログイン中フラグ
     */
    public function isChargerLoggedIn(): bool
    {
        return $this->session->get(self::SESSION_CHARGER_KEY) === true;
    }

    /**
     * 予約者がログイン中かチェック
     * 
     * @return bool ログイン中フラグ
     */
    public function isReserverLoggedIn(): bool
    {
        return $this->session->get(self::SESSION_RESERVER_KEY) === true;
    }

    /**
     * ログイン中の担当者情報を取得
     * 
     * @return array|null 担当者情報 or null
     */
    public function getChargerData(): ?array
    {
        if (!$this->isChargerLoggedIn()) {
            return null;
        }

        return $this->session->get(self::SESSION_CHARGER_DATA);
    }

    /**
     * ログイン中の予約者情報を取得
     * 
     * @return array|null 予約者情報 or null
     */
    public function getReserverData(): ?array
    {
        if (!$this->isReserverLoggedIn()) {
            return null;
        }

        return $this->session->get(self::SESSION_RESERVER_DATA);
    }

    /**
     * 担当者が管理者権限を持っているかチェック
     * 
     * @return bool 管理者権限フラグ
     */
    public function isAdmin(): bool
    {
        $charger = $this->getChargerData();

        if (!$charger) {
            return false;
        }

        return $charger['charger_type'] === ChargerModel::TYPE_ADMIN;
    }

    /**
     * 担当者がオーガナイザー権限を持っているかチェック
     * 
     * @return bool オーガナイザー権限フラグ
     */
    public function isOrganizer(): bool
    {
        $charger = $this->getChargerData();

        if (!$charger) {
            return false;
        }

        return $charger['charger_type'] === ChargerModel::TYPE_ORGANIZER;
    }

    /**
     * ログイン中の担当者IDを取得
     * 
     * @return string|null 担当者ID or null
     */
    public function getChargerId(): ?string
    {
        $charger = $this->getChargerData();
        return $charger['charger_id'] ?? null;
    }

    /**
     * ログイン中の予約者IDを取得
     * 
     * @return string|null 予約者ID or null
     */
    public function getReserverId(): ?string
    {
        $reserver = $this->getReserverData();
        return $reserver['reserver_id'] ?? null;
    }
}
