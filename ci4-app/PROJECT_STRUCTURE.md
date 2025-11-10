# プロジェクト構造ドキュメント

## 概要
このドキュメントは、`.github/copilot-instructions.md`に準拠した旅行予約管理システムのプロジェクト構造を説明します。

## ディレクトリ構造

### Controllers（コントローラー層）

#### Admin（管理画面）
```
app/Controllers/Admin/
├── Dashboard.php              # ダッシュボード
├── Reserver/
│   └── ReserverController.php # 予約者管理
├── Member/
│   └── MemberController.php   # 会員管理
├── Option/
│   └── OptionController.php   # オプション管理
├── CarRental/
│   └── CarRentalController.php # レンタカー管理
└── Auth/
    ├── LoginController.php    # ログイン
    └── LogoutController.php   # ログアウト
```

#### Front（フロント画面）
```
app/Controllers/Front/
├── Home.php                   # ホーム
├── Reservation/
│   └── ReservationController.php # 予約処理
└── Auth/
    ├── LoginController.php    # 会員ログイン
    └── RegisterController.php # 会員登録
```

### Models（モデル層）

```
app/Models/
├── Reserver/
│   ├── ReserverModel.php     # 予約者
│   ├── MemberModel.php       # 会員
│   └── NoteModel.php         # 備考・メモ
├── Option/
│   ├── OptionModel.php       # オプション（エイリアス）
│   ├── OptionMasterModel.php # オプションマスタ
│   ├── OptionTimeModel.php   # オプション時間別在庫
│   └── OptionReservationModel.php # オプション予約
└── CarRental/
    ├── CarRentalModel.php    # レンタカー予約
    └── CarRentalStockModel.php # レンタカー在庫
```

### Services（サービス層）

```
app/Services/
├── Reservation/
│   ├── ReservationService.php # 予約サービス
│   └── MemberService.php      # 会員サービス
├── Option/
│   ├── OptionService.php      # オプションサービス
│   └── AvailabilityService.php # 在庫・空き状況サービス
└── CarRental/
    └── CarRentalService.php   # レンタカーサービス
```

### Views（ビュー層）

#### Admin（管理画面）
```
app/Views/admin/
├── layouts/
│   ├── main.php              # メインレイアウト
│   └── sidebar.php           # サイドバー
├── reserver/
│   ├── list.php              # 予約者一覧
│   ├── edit.php              # 予約者編集
│   └── detail.php            # 予約者詳細
├── member/
│   ├── list.php              # 会員一覧
│   └── edit.php              # 会員編集
├── option/                   # オプション管理画面
└── car_rental/               # レンタカー管理画面
```

#### Front（フロント画面）
```
app/Views/front/
├── layouts/
│   ├── main.php              # メインレイアウト
│   ├── header.php            # ヘッダー
│   └── footer.php            # フッター
├── reservation/
│   ├── step1.php             # 予約ステップ1
│   ├── step2.php             # 予約ステップ2
│   └── confirm.php           # 予約確認
└── auth/                     # 認証画面
```

### Public Assets（公開アセット）

```
public/
├── admin/
│   ├── css/
│   │   └── app.css           # 管理画面CSS
│   ├── js/
│   │   └── alpinejs/
│   │       ├── sidebar.js    # サイドバーコンポーネント
│   │       ├── dropdown.js   # ドロップダウン
│   │       ├── modal.js      # モーダル
│   │       └── toast.js      # トーストメッセージ
│   └── images/
└── front/
    ├── css/
    │   └── app.css           # フロントCSS
    ├── js/
    │   └── alpinejs/         # Alpine.jsコンポーネント
    └── images/
```

## ルーティング設計

### Admin Routes
```php
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'admin-auth'], function($routes) {
    // ダッシュボード
    $routes->get('/', 'DashboardController::index');
    
    // 予約者管理
    $routes->resource('reserver', ['controller' => 'Reserver\ReserverController']);
    
    // 会員管理
    $routes->resource('member', ['controller' => 'Member\MemberController']);
    
    // オプション管理
    $routes->resource('option', ['controller' => 'Option\OptionController']);
    
    // レンタカー管理
    $routes->resource('car-rental', ['controller' => 'CarRental\CarRentalController']);
});
```

### Front Routes
```php
$routes->group('/', ['namespace' => 'App\Controllers\Front'], function($routes) {
    // ホーム
    $routes->get('/', 'Home::index');
    
    // 予約フロー
    $routes->get('reservation/step1', 'Reservation\ReservationController::step1');
    $routes->get('reservation/step2', 'Reservation\ReservationController::step2');
    $routes->get('reservation/confirm', 'Reservation\ReservationController::confirm');
});

$routes->group('auth', ['namespace' => 'App\Controllers\Front\Auth'], function($routes) {
    // 認証
    $routes->get('login', 'LoginController::index');
    $routes->get('register', 'RegisterController::index');
});
```

## 技術スタック

- **Backend**: CodeIgniter 4.x + PHP 8.3
- **Frontend**: Alpine.js（jQuery不使用）
- **UI Framework**: Bootstrap 5 + Velzon Template
- **Database**: MySQL/MariaDB
- **Package Management**: Composer

## コーディング規約

- PSR-12準拠
- インデント: スペース4つ
- 変数・関数名: 英語
- コメント: 日本語
- MVCパターン + Service層の完全分離
- Alpine.jsで動的UI実装（SPAではなくMPAアーキテクチャ）

## 開発ルール

1. **axaepcディレクトリ**: 参考設計のみ（コード流用禁止）
2. **jQuery使用禁止**: Alpine.jsのみ使用
3. **MVC+Service層分離**: ビジネスロジックはService層に配置
4. **管理画面とフロント分離**: Controller、View、Assetsすべて分離
5. **セキュリティ対策**: SQLインジェクション、XSS、CSRF対策必須

## 次のステップ

1. 各コントローラーのビジネスロジック実装
2. ビューの詳細実装（フォーム、一覧表示など）
3. Alpine.jsコンポーネントの拡張
4. テストコードの作成
5. データベースマイグレーションの実行

## 参考資料

- `.github/copilot-instructions.md`: プロジェクト全体のガイドライン
- `axadb_2025.sql`: データベーススキーマ定義
- CodeIgniter 4 ドキュメント: https://codeigniter4.github.io/userguide/
