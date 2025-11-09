# GitHub Copilot 指示

## プロジェクト概要
このプロジェクトは管理画面のテンプレート機能を提供するWebアプリケーションで、CodeIgniter 4フレームワーク（PHPベース）を使用しています。管理者がテンプレートの作成、編集、削除、プレビュー機能を利用できる管理システムです。

## 技術スタック
- バックエンド：CodeIgniter 4
- フロントエンド：Vue.js 3（jQueryは使用せず、Vue.jsで動的UIを実装）
- スタイル/UI：Bootstrap 5 + Velzon（Bootstrap 5ベース管理画面テンプレート）
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
│   │   ├── Dashboard.php
│   │   ├── Template/
│   │   │   ├── TemplateController.php
│   │   │   ├── CategoryController.php
│   │   │   └── VersionController.php
│   │   ├── User/
│   │   │   └── UserController.php
│   │   └── Auth/
│   │       ├── LoginController.php
│   │       └── LogoutController.php
│   │
│   └── Front/                     # フロント画面専用コントローラー
│       ├── Home.php
│       ├── Template/
│       │   ├── TemplateViewController.php
│       │   └── TemplateSearchController.php
│       └── Auth/
│           ├── LoginController.php
│           └── RegisterController.php
│
├── Models/                        # 共通モデル（Admin/Front両方で使用）
│   ├── Template/
│   │   ├── TemplateModel.php
│   │   ├── CategoryModel.php
│   │   └── VersionModel.php
│   └── User/
│       └── UserModel.php
│
├── Views/
│   ├── admin/                     # 管理画面ビュー
│   │   ├── layouts/
│   │   │   ├── main.php          # 管理画面共通レイアウト
│   │   │   └── sidebar.php
│   │   ├── dashboard/
│   │   │   └── index.php
│   │   ├── template/
│   │   │   ├── list.php
│   │   │   ├── create.php
│   │   │   ├── edit.php
│   │   │   └── preview.php
│   │   └── auth/
│   │       └── login.php
│   │
│   └── front/                     # フロント画面ビュー
│       ├── layouts/
│       │   ├── main.php          # フロント共通レイアウト
│       │   ├── header.php
│       │   └── footer.php
│       ├── home/
│       │   └── index.php
│       ├── template/
│       │   ├── list.php
│       │   ├── detail.php
│       │   └── search.php
│       └── auth/
│           ├── login.php
│           └── register.php
│
├── Services/                      # ビジネスロジック層（共通）
│   ├── Template/
│   │   ├── TemplateService.php
│   │   ├── CategoryService.php
│   │   ├── VersionService.php
│   │   └── ExportService.php
│   └── User/
│       └── AuthService.php
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
    └── Seeds/                     # テストデータ
```

**アセット構造（public/）:**
```
public/
├── admin/                         # 管理画面専用アセット
│   ├── css/
│   ├── js/
│   │   └── vue/                  # Vue.js コンポーネント
│   └── images/
│
└── front/                         # フロント専用アセット
    ├── css/
    ├── js/
    │   └── vue/
    └── images/
```

**その他:**
- `writable/`: ログ、キャッシュ、セッションファイル
- `vendor/`: Composerパッケージ
- `node_modules/`: npm パッケージ（Vue.js、Tailwind CSS等）

**ルーティング設計:**
```php
// Config/Routes.php
// Admin routes
$routes->group('admin', ['filter' => 'admin-auth', 'namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->resource('templates', ['controller' => 'Template\TemplateController']);
    $routes->resource('categories', ['controller' => 'Template\CategoryController']);
});

// Front routes
$routes->group('/', ['namespace' => 'App\Controllers\Front'], function($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('templates', 'Template\TemplateViewController::index');
    $routes->get('templates/(:num)', 'Template\TemplateViewController::show/$1');
});
```
## 重要なディレクトリとファイル
- `public/`: 静的ファイル（CSS、JavaScript、画像など）
- `writable/`: ログ、キャッシュ、セッションファイル
- `vendor/`: Composerパッケージ
- `node_modules/`: npm パッケージ（Vue.js、Tailwind CSS等）

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
- Vue.js/JavaScriptコード: 
  - jQueryは使用せず、Vue.js 3をjQueryの代用品として動的UIを実装
  - 既存のHTMLにVue.jsインスタンスをマウントして部分的な動的機能を提供
  - SPAは実装せず、従来のMPAアーキテクチャを維持
  - DOM操作、イベントハンドリング、フォーム処理にVue.jsを活用
  - API通信にはaxiosライブラリを使用
  - 複雑なコンポーネント設計は避け、シンプルなVueインスタンスを優先
- CSS: Tailwind CSSのユーティリティクラスを優先的に使用
- UIコンポーネント: Prelineコンポーネントを活用

## アプリケーション特有の知識
- このアプリケーションは管理画面のテンプレート機能に特化した管理システムです
- テンプレートの作成、編集、削除、複製、プレビュー機能を提供します
- テンプレートカテゴリによる分類・管理機能が含まれています
- HTMLテンプレートエディタ、メールテンプレート、通知テンプレートなど複数のテンプレート種別に対応
- テンプレート変数（プレースホルダー）の動的置換機能（例: {{variable_name}}）
- テンプレートバージョン管理機能（履歴・復元機能）
- テンプレートのインポート/エクスポート機能（Excel、JSON形式）
- Vue.jsベースのリアルタイムプレビュー機能
- 日本語テンプレートに対応（文字コードUTF-8）
- レスポンシブデザイン対応（Bootstrap 5使用）

## セキュリティ要件
- SQLインジェクション対策のためにCodeIgniter 4のクエリビルダを使用
- XSS対策のためにユーザー入力のエスケープを適切に行う
- CSRFトークンを使用して、クロスサイトリクエストフォージェリを防止
- テンプレート内のHTMLコードに対するサニタイゼーション処理
- ファイルアップロード時の拡張子チェックとMIMEタイプ検証
- テンプレート変数の不正な値注入を防ぐバリデーション
- 管理者権限の適切なアクセス制御（CodeIgniter 4のFiltersを使用）
- テンプレート編集時の権限チェック
- Vue.jsコンポーネント間でのセキュアなデータ受け渡し

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
- Vue.jsコンポーネントの設計：
  - 単一責任の原則に従い、再利用可能なコンポーネントを作成
  - props、emit、composablesを適切に使用
  - Composition APIを優先的に使用
  - 既存のHTMLページにVue.jsを段階的に導入
  - ページごとに独立したVueインスタンスを作成
  - 大規模なコンポーネント階層は避け、フラットな構造を維持
  - 管理画面とフロントでVueコンポーネントを分離管理
- Bootstrap 5 + Velzonの活用：
  - Bootstrap 5のコンポーネントとユーティリティクラスを優先的に使用
  - Velzonテンプレートの既存レイアウト・コンポーネントを活用
  - カスタムCSSが必要な場合はBootstrapの変数・mixinを使用
  - Vue.jsとBootstrapコンポーネント（モーダル、ドロップダウンなど）の統合に注意
- テンプレートエディタにはWYSIWYGエディタ（Vue.js対応）の統合を検討
- テンプレート変数の命名規則を統一（例: {{variable_name}}）
- テンプレートバージョン管理のためのデータベース設計に注意
- プレビュー機能でのセキュリティリスクを考慮した実装
- 大量のテンプレートデータに対するパフォーマンス最適化
- API設計はRESTful原則に従い、適切なHTTPステータスコードを返す

## テスト
- 変更を加える前に既存の機能への影響を十分に検討
- データベース操作を伴う機能は特に注意深くテスト
- Vue.jsコンポーネントの単体テスト実装を推奨
- API endpoints のテスト実装

このファイルは随時更新されます。質問や提案があれば追記してください。