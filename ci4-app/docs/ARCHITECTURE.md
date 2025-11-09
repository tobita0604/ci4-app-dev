# システムアーキテクチャ設計書

## プロジェクト概要
CodeIgniter 4 ベースの管理画面テンプレート管理システム。Alpine.js を使用した軽量でセキュアなUI実装。

## 技術スタック

### バックエンド
- **フレームワーク**: CodeIgniter 4.6.1
- **PHP バージョン**: 8.3
- **アーキテクチャ**: MVC + Service Layer

### フロントエンド
- **UI フレームワーク**: Alpine.js 3.x（CDN）
- **CSS フレームワーク**: Bootstrap 5（CSS のみ、JS削除）
- **管理画面テンプレート**: Velzon
- **アイコン**: Remix Icon

### データベース
- MySQL / MariaDB
- マイグレーションベースのスキーマ管理

### 主要ライブラリ
- `phpoffice/phpspreadsheet` - Excel操作
- `symfony/cache` - キャッシュ管理
- `tecnickcom/tcpdf` - PDF生成
- `setasign/fpdi` - PDF編集・合成

## ディレクトリ構造

```
ci4-app/
├── app/
│   ├── Controllers/
│   │   ├── Admin/              # 管理画面コントローラー
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   └── LogoutController.php
│   │   │   ├── Template/
│   │   │   │   ├── TemplateController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   └── VersionController.php
│   │   │   ├── User/
│   │   │   │   └── UserController.php
│   │   │   └── DashboardController.php
│   │   │
│   │   └── Front/              # フロント画面コントローラー
│   │       ├── Auth/
│   │       │   ├── LoginController.php
│   │       │   └── RegisterController.php
│   │       ├── Template/
│   │       │   ├── TemplateViewController.php
│   │       │   └── TemplateSearchController.php
│   │       └── Home.php
│   │
│   ├── Models/                 # データモデル（共通）
│   │   ├── Template/
│   │   │   ├── TemplateModel.php
│   │   │   ├── CategoryModel.php
│   │   │   └── VersionModel.php
│   │   └── User/
│   │       └── UserModel.php
│   │
│   ├── Services/               # ビジネスロジック層
│   │   ├── Template/
│   │   │   ├── TemplateService.php
│   │   │   ├── CategoryService.php
│   │   │   ├── VersionService.php
│   │   │   └── ExportService.php
│   │   └── User/
│   │       └── AuthService.php
│   │
│   ├── Views/
│   │   ├── admin/              # 管理画面ビュー
│   │   │   ├── layouts/
│   │   │   ├── partials/
│   │   │   ├── dashboard/
│   │   │   ├── template/
│   │   │   └── auth/
│   │   │
│   │   └── front/              # フロント画面ビュー
│   │       ├── layouts/
│   │       ├── home/
│   │       ├── template/
│   │       └── auth/
│   │
│   ├── Filters/                # アクセス制御
│   │   ├── AdminAuthFilter.php
│   │   └── FrontAuthFilter.php
│   │
│   ├── Database/
│   │   ├── Migrations/         # スキーマ管理
│   │   └── Seeds/              # テストデータ
│   │
│   └── Config/
│       └── Routes.php          # ルーティング設定
│
├── public/
│   ├── admin/                  # 管理画面専用アセット
│   │   ├── css/
│   │   ├── js/
│   │   │   └── alpine/        # Alpine.jsコンポーネント
│   │   └── images/
│   │
│   ├── front/                  # フロント専用アセット
│   │   ├── css/
│   │   ├── js/
│   │   │   └── alpine/
│   │   └── images/
│   │
│   └── assets/                 # 共通アセット（Velzonテンプレート）
│       ├── css/
│       ├── js/
│       ├── libs/
│       └── images/
│
└── docs/                       # ドキュメント
    ├── ARCHITECTURE.md
    ├── ALPINEJS_COMPONENTS.md
    └── DATABASE.md
```

## レイヤー構造

### 1. プレゼンテーション層（Views + Alpine.js）
- **責任**: ユーザーインターフェースの表示、ユーザー入力の受付
- **技術**: PHP（View）、Alpine.js、Bootstrap 5 CSS
- **ルール**:
  - ビジネスロジックを含めない
  - Alpine.js で動的UI実装（jQuery/Bootstrap JS 不使用）
  - Bootstrap CSS のみ使用

### 2. コントローラー層（Controllers）
- **責任**: HTTPリクエストの処理、バリデーション、レスポンス生成
- **技術**: CodeIgniter 4 Controllers
- **ルール**:
  - 薄いコントローラーを維持（Fat Model, Thin Controller）
  - ビジネスロジックは Service 層に委譲
  - 認証・認可のフィルター適用

### 3. サービス層（Services）
- **責任**: ビジネスロジック、複雑な処理の集約
- **技術**: PHP クラス
- **ルール**:
  - 再利用可能なビジネスロジックを実装
  - トランザクション管理
  - 複数モデルの協調処理

### 4. モデル層（Models）
- **責任**: データアクセス、基本的なCRUD操作
- **技術**: CodeIgniter 4 Models
- **ルール**:
  - データベース操作のみ
  - クエリビルダー使用（SQLインジェクション対策）
  - バリデーションルールの定義

### 5. データベース層
- **責任**: データの永続化
- **技術**: MySQL/MariaDB
- **ルール**:
  - マイグレーションでスキーマ管理
  - 外部キー制約の適用
  - インデックスの適切な設定

## セキュリティ設計

### 認証・認可
- **認証フィルター**: `AdminAuthFilter`, `FrontAuthFilter`
- **セッション管理**: CodeIgniter 4 Session Library
- **パスワードハッシュ**: PHP `password_hash()` / `password_verify()`

### XSS対策
- **自動エスケープ**: ビューでの出力時に `esc()` 関数使用
- **CSP**: Content Security Policy ヘッダー設定
- **サニタイゼーション**: テンプレート変数の入力バリデーション

### CSRF対策
- **CSRFトークン**: CodeIgniter 4 の自動CSRF保護
- **フォーム**: すべてのフォームに `csrf_field()` 挿入

### SQLインジェクション対策
- **クエリビルダー**: プリペアドステートメント使用
- **パラメータバインディング**: 動的SQL生成時の適切な処理

### ファイルアップロード対策
- **拡張子チェック**: ホワイトリスト方式
- **MIMEタイプ検証**: `finfo_file()` 使用
- **ファイルサイズ制限**: アップロードサイズの適切な設定

## Alpine.js統合設計

### Bootstrap JS 完全削除の方針
- **理由**: セキュリティ脆弱性対応の負担軽減
- **代替**: Alpine.js で同等機能を実装
- **メリット**:
  - 軽量（Bootstrap JS: 80KB → Alpine.js: 15KB）
  - セキュリティリスク低減
  - メンテナンス負担軽減

### 置き換え対象コンポーネント
| Bootstrap JS コンポーネント | Alpine.js 実装 |
|---------------------------|--------------|
| サイドバー（Offcanvas）        | `sidebar.js` |
| ドロップダウン                 | `dropdown.js` |
| モーダル                      | `modal.js` |
| トースト                      | `toast.js` |
| アコーディオン                 | `accordion.js` |
| タブ                         | `tabs.js` |

### Alpine.js コンポーネント設計原則
1. **宣言的アプローチ**: HTML に直接ディレクティブを記述
2. **独立性**: 各コンポーネントは独立して動作
3. **再利用性**: 複数ページで使い回し可能
4. **軽量性**: 必要最小限の機能実装

## データベース設計

### テーブル構成

#### users テーブル
管理者・ユーザー情報を管理

| カラム名 | 型 | 説明 |
|---------|---|------|
| id | INT | 主キー |
| username | VARCHAR(100) | ユーザー名（ユニーク） |
| email | VARCHAR(255) | メールアドレス（ユニーク） |
| password_hash | VARCHAR(255) | パスワードハッシュ |
| role | ENUM | 権限（admin, user, guest） |
| is_active | TINYINT | 有効/無効フラグ |
| last_login | DATETIME | 最終ログイン日時 |
| created_at | DATETIME | 作成日時 |
| updated_at | DATETIME | 更新日時 |

#### categories テーブル
テンプレートカテゴリを管理

| カラム名 | 型 | 説明 |
|---------|---|------|
| id | INT | 主キー |
| name | VARCHAR(100) | カテゴリ名 |
| slug | VARCHAR(100) | URL用スラッグ（ユニーク） |
| description | TEXT | 説明 |
| parent_id | INT | 親カテゴリID（NULL可） |
| display_order | INT | 表示順序 |
| is_active | TINYINT | 有効/無効フラグ |
| created_at | DATETIME | 作成日時 |
| updated_at | DATETIME | 更新日時 |

#### templates テーブル
テンプレート本体を管理

| カラム名 | 型 | 説明 |
|---------|---|------|
| id | INT | 主キー |
| category_id | INT | カテゴリID（外部キー） |
| name | VARCHAR(255) | テンプレート名 |
| slug | VARCHAR(255) | URL用スラッグ（ユニーク） |
| type | ENUM | 種別（html, email, notification） |
| description | TEXT | 説明 |
| content | LONGTEXT | テンプレート本文 |
| variables | JSON | テンプレート変数定義 |
| is_active | TINYINT | 有効/無効フラグ |
| version | INT | 現在のバージョン番号 |
| created_by | INT | 作成者ID（外部キー） |
| updated_by | INT | 更新者ID（外部キー） |
| created_at | DATETIME | 作成日時 |
| updated_at | DATETIME | 更新日時 |

#### template_versions テーブル
テンプレート変更履歴を管理

| カラム名 | 型 | 説明 |
|---------|---|------|
| id | INT | 主キー |
| template_id | INT | テンプレートID（外部キー） |
| version_number | INT | バージョン番号 |
| content | LONGTEXT | このバージョンの本文 |
| variables | JSON | このバージョンの変数 |
| change_description | TEXT | 変更内容説明 |
| created_by | INT | 作成者ID（外部キー） |
| created_at | DATETIME | 作成日時 |

### リレーションシップ
- `templates.category_id` → `categories.id` (多対1)
- `templates.created_by` → `users.id` (多対1)
- `templates.updated_by` → `users.id` (多対1)
- `template_versions.template_id` → `templates.id` (多対1、CASCADE削除)
- `template_versions.created_by` → `users.id` (多対1)
- `categories.parent_id` → `categories.id` (自己参照、階層構造)

## ルーティング設計

### 管理画面ルート（`/admin`）
```php
$routes->group('admin', ['filter' => 'admin-auth', 'namespace' => 'App\Controllers\Admin'], function($routes) {
    // ダッシュボード
    $routes->get('/', 'DashboardController::index');
    
    // テンプレート管理
    $routes->resource('templates', ['controller' => 'Template\TemplateController']);
    $routes->get('templates/(:num)/preview', 'Template\TemplateController::preview/$1');
    $routes->post('templates/(:num)/duplicate', 'Template\TemplateController::duplicate/$1');
    
    // カテゴリ管理
    $routes->resource('categories', ['controller' => 'Template\CategoryController']);
    
    // バージョン管理
    $routes->get('templates/(:num)/versions', 'Template\VersionController::index/$1');
    $routes->post('templates/(:num)/versions/restore', 'Template\VersionController::restore/$1');
    
    // ユーザー管理
    $routes->resource('users', ['controller' => 'User\UserController']);
    
    // 認証
    $routes->get('login', 'Auth\LoginController::index');
    $routes->post('login', 'Auth\LoginController::login');
    $routes->get('logout', 'Auth\LogoutController::index');
});
```

### フロント画面ルート（`/`）
```php
$routes->group('/', ['namespace' => 'App\Controllers\Front'], function($routes) {
    $routes->get('/', 'Home::index');
    
    // テンプレート閲覧
    $routes->get('templates', 'Template\TemplateViewController::index');
    $routes->get('templates/(:segment)', 'Template\TemplateViewController::show/$1');
    $routes->get('search', 'Template\TemplateSearchController::index');
    
    // 認証
    $routes->get('login', 'Auth\LoginController::index');
    $routes->post('login', 'Auth\LoginController::login');
    $routes->get('register', 'Auth\RegisterController::index');
    $routes->post('register', 'Auth\RegisterController::register');
});
```

## 開発ガイドライン

### コーディング規約
- **PHP**: PSR-12 準拠
- **インデント**: スペース4つ
- **PHPDoc**: すべてのクラス・メソッドに記述
- **命名規則**: 英語（変数・関数）、日本語（コメント）

### Alpine.js 開発ルール
1. jQuery は使用禁止
2. Bootstrap JS は使用禁止（CSS のみ）
3. `x-data` スコープを適切に分離
4. グローバルストアを活用
5. アクセシビリティ（ARIA属性）を考慮

### Git ワークフロー
- **main**: 本番環境
- **develop**: 開発環境
- **feature/***: 機能開発ブランチ
- **hotfix/***: 緊急修正ブランチ

## パフォーマンス最適化

### フロントエンド
- Alpine.js は CDN から defer 読み込み
- CSS/JS の最小化（本番環境）
- 画像の遅延読み込み（Lazy Loading）
- ブラウザキャッシュ活用

### バックエンド
- クエリの最適化（N+1問題の回避）
- Symfony Cache によるキャッシュ管理
- ページネーション実装（大量データ対応）
- データベースインデックスの適切な設定

## 今後の拡張予定
- [ ] テンプレートエクスポート機能（Excel、JSON）
- [ ] テンプレートインポート機能
- [ ] WYSIWYG エディタ統合（Alpine.js 対応）
- [ ] リアルタイムプレビュー機能
- [ ] テンプレート変数の動的検証
- [ ] 多言語対応（i18n）
- [ ] API エンドポイント（RESTful API）

---

**最終更新**: 2025-11-09
