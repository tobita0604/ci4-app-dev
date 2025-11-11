# GitHub Copilot 指示

## プロジェクト概要
このプロジェクトは旅行予約管理システムで、CodeIgniter 4フレームワーク（PHPベース）を使用しています。予約者情報管理、メンバー情報、オプションツアー予約、レンタカー予約などの機能を提供する管理システムです。

## 技術スタック
- バックエンド：CodeIgniter 4
- フロントエンド：Alpine.js（jQueryは使用せず、Alpine.jsで動的UIを実装）
- スタイル/UI：Bootstrap 5 + Velzon テンプレート
- 主要PHPライブラリ（Composer管理）：
  - `phpoffice/phpspreadsheet`（Excelファイル操作）
  - `symfony/cache`（キャッシュ機能）
  - `tecnickcom/tcpdf`（PDF生成）
  - `setasign/fpdi`（PDF編集・合成）

## プロジェクト構造
```
app/
├── Controllers/
│   ├── Admin/                     # 管理画面専用コントローラー
│   │   ├── DashboardController.php
│   │   ├── Reserver/
│   │   │   └── ReserverController.php
│   │   ├── Member/
│   │   │   └── MemberController.php
│   │   ├── Option/
│   │   │   └── OptionController.php
│   │   ├── CarRental/
│   │   │   └── CarRentalController.php
│   │   └── Auth/
│   │       ├── LoginController.php
│   │       └── LogoutController.php
│   │
│   └── Front/                     # フロント画面専用コントローラー
│       ├── Home.php
│       ├── Reservation/
│       │   └── ReservationController.php
│       └── Auth/
│           ├── LoginController.php
│           └── RegisterController.php
│
├── Models/                        # 共通モデル（Admin/Front両方で使用）
│   ├── Reserver/
│   │   ├── ReserverModel.php
│   │   ├── MemberModel.php
│   │   └── NoteModel.php
│   ├── Option/
│   │   ├── OptionModel.php
│   │   ├── OptionMasterModel.php
│   │   ├── OptionReservationModel.php
│   │   └── OptionTimeModel.php
│   ├── CarRental/
│   │   ├── CarRentalModel.php
│   │   └── CarRentalStockModel.php
│   ├── ChargerModel.php
│   └── AdminIpModel.php
│
├── Views/
│   ├── admin/                     # 管理画面ビュー
│   │   ├── layouts/
│   │   │   ├── main.php          # 管理画面共通レイアウト
│   │   │   └── sidebar.php
│   │   ├── partials/
│   │   │   ├── menu.php
│   │   │   ├── sidebar.php
│   │   │   ├── topbar.php
│   │   │   └── footer.php
│   │   ├── auth/
│   │   │   └── login.php
│   │   ├── dashboard.php
│   │   ├── reserver/
│   │   │   ├── list.php
│   │   │   ├── edit.php
│   │   │   └── detail.php
│   │   ├── member/
│   │   ├── option/
│   │   └── car_rental/
│   │
│   └── front/                     # フロント画面ビュー
│       ├── layouts/
│       │   ├── main.php          # フロント共通レイアウト
│       │   ├── header.php
│       │   └── footer.php
│       ├── home.php
│       ├── reservation/
│       │   ├── step1.php
│       │   ├── step2.php
│       │   └── confirm.php
│       └── auth/
│           ├── login.php
│           └── register.php
│
├── Services/                      # ビジネスロジック層（共通）
│   ├── Reservation/
│   │   ├── ReservationService.php
│   │   └── MemberService.php
│   ├── Option/
│   │   ├── OptionService.php
│   │   └── AvailabilityService.php
│   ├── CarRental/
│   │   └── CarRentalService.php
│   └── Auth/
│       ├── AuthService.php
│       └── IpRestrictionService.php
│
├── Filters/                       # アクセス制御
│   ├── AdminAuthFilter.php       # 管理画面認証フィルター
│   └── FrontAuthFilter.php       # フロント認証フィルター
│
├── Libraries/                     # カスタムライブラリ
├── Helpers/                       # ヘルパー関数
├── Config/                        # 設定ファイル
│   └── Routes.php                # ルーティング設定（admin/frontで分離）
└── Database/
    ├── Migrations/                # データベースマイグレーション
    │   ├── 2025-11-09-160000_CreateChargerTable.php
    │   ├── 2025-11-09-160100_CreateReserverTable.php
    │   ├── 2025-11-09-160200_CreateMemberTable.php
    │   ├── 2025-11-09-160300_CreateCarRentalTable.php
    │   ├── 2025-11-09-160400_CreateNoteTable.php
    │   ├── 2025-11-09-160500_CreateOptionReservationTable.php
    │   ├── 2025-11-09-160600_CreateOptionMasterTable.php
    │   ├── 2025-11-09-160700_CreateOptionAvailableTable.php
    │   ├── 2025-11-09-160800_CreateOptionTimeTable.php
    │   ├── 2025-11-09-160900_CreateCarRentalStockTable.php
    │   ├── 2025-11-09-161000_CreateReserverBackupTable.php
    │   ├── 2025-11-09-161100_CreateReserverTestdataTable.php
    │   └── 2025-11-09-161200_CreateAdminIpTable.php
    └── Seeds/                     # テストデータ
```

**アセット構造（public/）:**
```
public/
├── admin/                         # 管理画面専用アセット
│   ├── css/
│   ├── js/
│   │   └── alpinejs/             # Alpine.js コンポーネント
│   │       ├── sidebar.js
│   │       ├── dropdown.js
│   │       ├── modal.js
│   │       ├── toast.js
│   │       ├── accordion.js
│   │       └── tabs.js
│   └── images/
│
└── front/                         # フロント専用アセット
    ├── css/
    ├── js/
    │   └── alpinejs/
    └── images/
```

**その他:**
- `writable/`: ログ、キャッシュ、セッションファイル
- `vendor/`: Composerパッケージ
- `axadb_2025.sql`: データベーススキーマ（13テーブル）

**ルーティング設計:**
```php
// Config/Routes.php
// Admin routes
$routes->group('admin', ['filter' => 'admin-auth', 'namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->get('auth/login', 'Auth\LoginController::index');
    $routes->post('auth/login', 'Auth\LoginController::login');
    $routes->get('auth/logout', 'Auth\LogoutController::index');
    $routes->resource('reservers', ['controller' => 'Reserver\ReserverController']);
    $routes->resource('members', ['controller' => 'Member\MemberController']);
    $routes->resource('options', ['controller' => 'Option\OptionController']);
    $routes->resource('car-rentals', ['controller' => 'CarRental\CarRentalController']);
});

// Front routes
$routes->group('/', ['namespace' => 'App\Controllers\Front'], function($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('reservation', 'Reservation\ReservationController::step1');
    $routes->post('reservation/step2', 'Reservation\ReservationController::step2');
    $routes->post('reservation/confirm', 'Reservation\ReservationController::confirm');
    $routes->post('reservation/complete', 'Reservation\ReservationController::complete');
});
```
## 重要なディレクトリとファイル
- `public/`: 静的ファイル（CSS、JavaScript、画像など）
- `writable/`: ログ、キャッシュ、セッションファイル
- `vendor/`: Composerパッケージ
- `axadb_2025.sql`: レガシーデータベーススキーマ（参照のみ）
- `axaepc/`: レガシーPHPコード（機能要件参考のみ、コピー禁止）

## コーディング規約
- PHP: [PSR-12](https://www.php-fig.org/psr/psr-12/)準拠のコーディングスタイルを使用
- インデント: タブではなくスペース4つを使用
- コメント: 関数やクラスには適切なコメントを付与
- 言語: 変数名・関数名は英語、コメントは日本語を使用
- MVCパターンに従い、ビジネスロジックはサービス層に、データアクセスはモデルに、表示ロジックはビューに、リクエスト処理はコントローラーに配置
- PHPDocs: すべてのクラス、メソッド、関数には以下のPhPDocsを記述する
  - クラス: クラスの役割、責任、使用方法を明記
  - メソッド・関数: 引数の型と説明、戻り値の型と説明、例外がある場合はその説明
  - 複雑なロジックには、処理内容のフローをコメントとして記載
- Alpine.js/JavaScriptコード: 
  - jQueryは使用せず、Alpine.js をjQueryの代用品として動的UIを実装
  - 既存のHTMLにAlpine.jsディレクティブを追加して部分的な動的機能を提供
  - SPAは実装せず、従来のMPAアーキテクチャを維持
  - DOM操作、イベントハンドリング、フォーム処理にAlpine.jsを活用
  - API通信にはfetch APIまたはaxiosライブラリを使用
  - 複雑なコンポーネント設計は避け、シンプルなAlpine.jsディレクティブを優先
- CSS: Bootstrap 5のユーティリティクラスを優先的に使用
- UIコンポーネント: Velzonテンプレートコンポーネントを活用

## アプリケーション特有の知識
- このアプリケーションは旅行予約管理システムです
- 予約者情報管理（ログイン認証、支社別管理、招待枠管理）
- メンバー情報管理（参加者情報、パスポート、ESTA情報）
- オプションツアー予約（ファーム見学、ゴルフ、在庫管理）
- レンタカー予約（在庫管理、運転免許証情報）
- 管理者機能（担当者管理、IP制限、バックアップ）
- 13テーブルのデータベース構造（axadb_2025.sql参照）
  1. c00_charger - 担当者管理
  2. r01_reserver - 予約者情報
  3. r01_member - メンバー情報
  4. r01_car_rental - レンタカー予約
  5. r01_note - 備考情報
  6. r01_reserver_backup - 予約者バックアップ
  7. r01_reserver_testdata - テストデータ
  8. r02_option - オプションツアー
  9. r02_car_rental_stock - レンタカー在庫
  10. m01_option - オプションマスタ
  11. m01_option_available - オプション利用可能期間
  12. m01_option_time - オプション時間別在庫
  13. r03_admin_ip - 管理者IP制限
- 日本語対応（文字コードUTF-8）
- レスポンシブデザイン対応（Bootstrap 5使用）

## セキュリティ要件
- SQLインジェクション対策のためにCodeIgniter 4のクエリビルダを使用
- XSS対策のためにユーザー入力のエスケープを適切に行う
- CSRFトークンを使用して、クロスサイトリクエストフォージェリを防止
- パスワードのハッシュ化（password_hash関数使用）
- ファイルアップロード時の拡張子チェックとMIMEタイプ検証
- 管理者権限の適切なアクセス制御（CodeIgniter 4のFiltersを使用）
- 管理者IP制限機能（r03_admin_ipテーブル）
- セッション管理とタイムアウト設定
- Alpine.jsコンポーネント間でのセキュアなデータ受け渡し
- レガシーコードは使用せず、すべて新規実装（セキュリティベストプラクティス遵守）

## 開発時の注意点
- 既存のコードスタイルに合わせて実装する
- サービス層を活用してコントローラーの肥大化を防ぐ
- 日本語対応（文字コードUTF-8）に注意
- 業務ロジックが複雑な場合は、適切にコメントを記載する
- **管理画面とフロント画面の分離:**
  - コントローラーは`Admin/`と`Front/`で明確に分離
  - ビューも`admin/`と`front/`で分離
  - アセット（CSS/JS）も`public/admin/`と`public/front/`で分離
  - モデル・サービスは共通利用（重複を避ける）
  - ルーティングは`admin`グループと`/`グループで分離
  - 認証フィルターは管理画面用とフロント用で別々に実装
- Alpine.jsコンポーネントの設計：
  - 単一責任の原則に従い、再利用可能なコンポーネントを作成
  - x-data、x-show、x-if、@clickなどのディレクティブを適切に使用
  - 既存のHTMLページにAlpine.jsを段階的に導入
  - ページごとに独立したAlpine.jsコンポーネント関数を作成
  - 大規模なコンポーネント階層は避け、フラットな構造を維持
  - 管理画面とフロントでAlpine.jsコンポーネントを分離管理
- Bootstrap 5 + Velzonの活用：
  - カスタムCSSよりもBootstrapのユーティリティクラスを優先
  - VelzonテンプレートコンポーネントをAlpine.jsで適切に初期化
- 予約フォームには適切なバリデーション実装
- 予約者情報、メンバー情報の入力フォーム設計
- オプションツアー選択UI（時間帯別在庫表示）
- レンタカー予約UI（クラス別在庫表示）
- 大量の予約データに対するパフォーマンス最適化
- API設計はRESTful原則に従い、適切なHTTPステータスコードを返す
- レガシーコード（axaepc/）は機能要件の参考のみに使用し、コード流用は禁止

## テスト
- 変更を加える前に既存の機能への影響を十分に検討
- データベース操作を伴う機能は特に注意深くテスト
- Alpine.jsコンポーネントのブラウザテスト実施
- API endpoints のテスト実装
- 予約処理のトランザクション整合性テスト

このファイルは随時更新されます。質問や提案があれば追記してください。