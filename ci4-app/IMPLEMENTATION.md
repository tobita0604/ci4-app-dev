# CI4旅行予約システム - 実装ドキュメント

## プロジェクト概要

CodeIgniter 4を使用した旅行予約管理システムの完全新規実装です。
レガシーシステム（axaepc）の要件を参考にしつつ、すべてのコードを最新のベストプラクティスに従って新規作成しました。

## 技術スタック

- **バックエンド**: PHP 8.3 + CodeIgniter 4.6
- **フロントエンド**: Alpine.js（jQuery完全排除）
- **UI/スタイル**: Bootstrap 5 + Velzon管理画面テンプレート
- **データベース**: MySQL/MariaDB
- **Composerパッケージ**:
  - phpoffice/phpspreadsheet（Excel操作）
  - symfony/cache（キャッシュ）
  - tecnickcom/tcpdf（PDF生成）
  - setasign/fpdi（PDF編集）

## データベース設計

### 13テーブル構成

#### 1. chargers（担当者管理）
- 営業担当者、オーガナイザー、管理者（KNT）の情報を管理
- パスワードハッシュ化対応
- 担当者種別: 0=営業担当者, 1=オーガナイザー, 9=管理者

#### 2. reservers（予約者情報）
- 旅行予約者の基本情報
- ログイン情報、招待枠管理
- 支社別管理、テストフラグ

#### 3. members（メンバー情報）
- 旅行参加メンバーの詳細情報
- パスポート情報、ESTA、緊急連絡先
- ベビー・幼児オプション管理

#### 4. car_rentals（レンタカー予約）
- レンタカー予約情報
- 運転免許証情報

#### 5. car_rental_stocks（レンタカー在庫）
- クラス別・日別在庫管理
- 在庫数、予約数、残数の自動計算

#### 6. option_masters（オプションマスタ）
- オプションツアーの基本情報
- 料金、営業時間、催行時間
- 日別受付可否設定

#### 7. option_reservations（オプション予約）
- メンバーごとのオプションツアー予約
- ファーム見学、ゴルフ、その他オプション
- 交通手段選択（シャトルバス/レンタカー）

#### 8. option_availables（オプション利用可能期間）
- オプションツアーの利用可能日と時間帯

#### 9. option_times（オプション時間別在庫）
- オプションツアーの時間帯別在庫管理

#### 10. notes（予約メモ）
- 予約に関する備考やメモ

#### 11. reserver_backups（予約者バックアップ）
- 予約者情報の履歴・バックアップ

#### 12. reserver_testdata（テストデータ）
- テスト用予約者データ（本番データと分離）

#### 13. admin_ips（管理者IP制限）
- 管理画面アクセス許可IPアドレス管理
- CIDR表記対応
- 論理削除対応

## アーキテクチャ

### MVC + Service層パターン

```
Controllers/
├── Admin/          # 管理画面
│   ├── Dashboard
│   ├── Reserver/
│   ├── Option/
│   └── Auth/
└── Front/          # フロント画面
    ├── Mypage/
    ├── Reservation/
    └── Auth/

Models/             # データアクセス層
├── ChargerModel
├── Reserver/
│   ├── ReserverModel
│   └── MemberModel
├── Option/
│   ├── OptionMasterModel
│   └── OptionReservationModel
└── CarRental/
    ├── CarRentalModel
    └── CarRentalStockModel

Services/           # ビジネスロジック層
├── Auth/
│   ├── AuthService
│   └── IpRestrictionService
├── Reserver/
│   └── ReservationService
└── Option/
    └── OptionService

Filters/            # アクセス制御
├── AdminAuthFilter
└── FrontAuthFilter
```

## 主要機能

### 認証機能（AuthService）

#### 担当者認証
```php
$authService = new AuthService();

// ログイン
$success = $authService->chargerLogin($chargerId, $password);

// ログイン状態確認
if ($authService->isChargerLoggedIn()) {
    $chargerData = $authService->getChargerData();
}

// 権限チェック
if ($authService->isAdmin()) {
    // 管理者のみの処理
}

// ログアウト
$authService->chargerLogout();
```

#### 予約者認証
```php
// ログイン
$success = $authService->reserverLogin($reserverId, $password);

// ログイン状態確認
if ($authService->isReserverLoggedIn()) {
    $reserverData = $authService->getReserverData();
}

// ログアウト
$authService->reserverLogout();
```

### IP制限機能（IpRestrictionService）

```php
$ipService = new IpRestrictionService();

// IPアドレスチェック
if ($ipService->isAllowed()) {
    // アクセス許可
} else {
    // アクセス拒否
}

// 現在のIPアドレス取得（プロキシ対応）
$currentIp = $ipService->getCurrentIp();

// IP登録
$ipService->registerIp('本社', '203.0.113.0/24');
```

### 予約管理機能（ReservationService）

```php
$reservationService = new ReservationService();

// 予約詳細取得（メンバー・オプション・レンタカー含む）
$details = $reservationService->getReservationDetails($reserverId);

// メンバー追加
$reservationService->addMember($reserverId, $memberData);

// 招待枠使用状況確認
$usage = $reservationService->getInviteUsage($reserverId);
// ['free_used' => 2, 'charge_used' => 1, 'free_remain' => 3, 'charge_remain' => 0]

// 予約ステータス取得
$status = $reservationService->getReservationStatus($reserverId);
// ['total_members' => 3, 'completed_members' => 2, 'completion_rate' => 66.7, ...]
```

## セキュリティ対策

### 実装済み対策

1. **パスワードハッシュ化**
   - `password_hash()` / `password_verify()` 使用
   - モデルのbeforeInsert/beforeUpdateフックで自動ハッシュ化

2. **セッション管理**
   - ログイン時のセッション再生成（セッションフィクセーション対策）
   - セキュアなセッションストレージ

3. **IP制限**
   - 管理画面へのIPアドレスベースアクセス制御
   - CIDR表記対応
   - プロキシ経由のIP取得対応

4. **SQLインジェクション対策**
   - CI4クエリビルダの使用
   - プリペアドステートメント

5. **XSS対策**
   - CI4の自動エスケープ機能
   - セキュリティヘッダー設定（X-XSS-Protection等）

6. **CSRF対策**
   - CI4のCSRFトークン機能（要設定）

## Alpine.jsコンポーネント

### 既存コンポーネント（public/admin/js/alpine/）

- **init.js**: グローバル設定、マジックプロパティ
- **toast.js**: トースト通知
- **modal.js**: モーダルウィンドウ
- **accordion.js**: アコーディオン
- **tabs.js**: タブ切り替え

### 実装予定

- サイドバートグル
- ドロップダウンメニュー
- 予約フォーム
- 在庫管理UI

## 開発ガイド

### マイグレーション実行

```bash
cd ci4-app
php spark migrate --all
```

### テスト実行

```bash
composer test
```

### コーディング規約

- **PSR-12準拠**
- **PHPDocs必須**（すべてのクラス・メソッド）
- **変数名・関数名**: 英語（キャメルケース/スネークケース）
- **コメント**: 日本語
- **インデント**: スペース4つ

## 次のステップ

### 未実装項目

1. **コントローラー実装**
   - 管理画面コントローラー（担当者管理、予約者管理、etc.）
   - フロント画面コントローラー（マイページ、予約、etc.）

2. **ビュー実装**
   - 管理画面ビュー（Velzon統合）
   - フロント画面ビュー（レスポンシブ対応）
   - Alpine.jsコンポーネント実装

3. **在庫管理サービス**
   - オプション在庫管理
   - レンタカー在庫管理

4. **シーダー作成**
   - 初期データ投入
   - テストデータ作成

5. **テスト作成**
   - ユニットテスト
   - 統合テスト

6. **ドキュメント整備**
   - API仕様書
   - ユーザーマニュアル

## 参考情報

- [CodeIgniter 4 ドキュメント](https://codeigniter4.github.io/userguide/)
- [Alpine.js ドキュメント](https://alpinejs.dev/)
- [Bootstrap 5 ドキュメント](https://getbootstrap.jp/docs/5.0/getting-started/introduction/)
- [PSR-12 コーディングスタイル](https://www.php-fig.org/psr/psr-12/)
