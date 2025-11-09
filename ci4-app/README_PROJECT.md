# CI4 テンプレート管理システム

CodeIgniter 4 ベースの管理画面テンプレート管理システム。Alpine.js を使用した軽量でセキュアなUI実装。

## 🎯 プロジェクト概要

このプロジェクトは、HTMLテンプレート、メールテンプレート、通知テンプレートなど、各種テンプレートを管理するための管理画面システムです。

### 主な機能
- ✅ テンプレートのCRUD操作（作成、閲覧、更新、削除）
- ✅ カテゴリによるテンプレート分類管理
- ✅ テンプレートバージョン管理（履歴・復元機能）
- ✅ テンプレート変数の動的置換機能（`{{variable_name}}`）
- ✅ リアルタイムプレビュー機能
- ✅ テンプレート複製機能
- ✅ 管理者/ユーザー認証・認可

## 🔧 技術スタック

### バックエンド
- **フレームワーク**: CodeIgniter 4.6.1
- **PHP**: 8.3
- **データベース**: MySQL / MariaDB
- **主要ライブラリ**:
  - `phpoffice/phpspreadsheet` - Excel操作
  - `symfony/cache` - キャッシュ管理
  - `tecnickcom/tcpdf` - PDF生成
  - `setasign/fpdi` - PDF編集・合成

### フロントエンド
- **UIフレームワーク**: Alpine.js 3.x（CDN）
- **CSSフレームワーク**: Bootstrap 5（CSS のみ）
- **管理画面テンプレート**: Velzon
- **アイコン**: Remix Icon

### セキュリティ方針
- ❌ **Bootstrap JS は完全削除** - Alpine.js で全機能を代替実装
- ❌ **jQuery は不使用** - レガシーな依存関係を排除
- ✅ **Alpine.js 採用** - 軽量（~15KB）で脆弱性リスクが低い

## 📁 プロジェクト構造

```
ci4-app/
├── app/
│   ├── Controllers/
│   │   ├── Admin/              # 管理画面コントローラー
│   │   │   ├── Auth/
│   │   │   ├── Template/
│   │   │   └── DashboardController.php
│   │   └── Front/              # フロント画面コントローラー
│   │
│   ├── Models/                 # データモデル
│   │   ├── Template/
│   │   │   ├── TemplateModel.php
│   │   │   ├── CategoryModel.php
│   │   │   └── VersionModel.php
│   │   └── User/
│   │
│   ├── Services/               # ビジネスロジック層
│   │   └── Template/
│   │       └── TemplateService.php
│   │
│   ├── Views/
│   │   ├── admin/              # 管理画面ビュー
│   │   └── front/              # フロント画面ビュー
│   │
│   ├── Filters/                # アクセス制御
│   │   ├── AdminAuthFilter.php
│   │   └── FrontAuthFilter.php
│   │
│   └── Database/
│       ├── Migrations/         # スキーマ管理
│       └── Seeds/              # テストデータ
│
├── public/
│   ├── admin/                  # 管理画面専用アセット
│   │   └── js/alpine/         # Alpine.jsコンポーネント
│   ├── front/                  # フロント専用アセット
│   └── assets/                 # 共通アセット（Velzon）
│
└── docs/                       # ドキュメント
    ├── ARCHITECTURE.md
    ├── ALPINEJS_COMPONENTS.md
    └── DATABASE.md
```

## 🚀 セットアップ

### 1. 環境要件
- PHP 8.3 以上
- MySQL 5.7 以上 または MariaDB 10.3 以上
- Composer
- Node.js（オプション：アセットビルド用）

### 2. インストール

```bash
# リポジトリのクローン
git clone <repository-url>
cd ci4-app

# Composer依存関係のインストール
composer install

# 環境設定ファイルのコピー
cp env .env

# .envファイルを編集してデータベース接続情報を設定
nano .env
```

### 3. データベース設定

`.env` ファイルでデータベース接続情報を設定：

```ini
database.default.hostname = localhost
database.default.database = ci4_template_db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix = 
```

### 4. マイグレーション実行

```bash
# すべてのマイグレーションを実行
php spark migrate

# マイグレーション状態の確認
php spark migrate:status
```

### 5. シードデータ投入（オプション）

```bash
# テスト用データを投入
php spark db:seed UserSeeder
php spark db:seed CategorySeeder
php spark db:seed TemplateSeeder
```

### 6. 開発サーバー起動

```bash
# CodeIgniter開発サーバー起動
php spark serve
```

ブラウザで `http://localhost:8080` にアクセス。

## 📖 使い方

### 管理画面へのアクセス
- **URL**: `http://localhost:8080/admin`
- **デフォルト管理者**:
  - ユーザー名: `admin`
  - パスワード: `password`（初回ログイン後変更推奨）

### テンプレート作成

1. 管理画面にログイン
2. 「テンプレート管理」→「新規作成」
3. 以下の情報を入力：
   - テンプレート名
   - スラッグ（URL用）
   - タイプ（HTML/メール/通知）
   - カテゴリ
   - 本文（`{{変数名}}` で変数を使用可能）
4. 「保存」をクリック

### テンプレート変数の使用

テンプレート本文で `{{変数名}}` の形式で変数を定義：

```html
<h1>こんにちは、{{user_name}}さん</h1>
<p>ご注文番号: {{order_id}}</p>
<p>ご注文日時: {{order_date}}</p>
```

変数定義（JSON形式）：

```json
{
  "user_name": {
    "type": "string",
    "required": true,
    "description": "ユーザー名"
  },
  "order_id": {
    "type": "integer",
    "required": true,
    "description": "注文ID"
  },
  "order_date": {
    "type": "date",
    "required": false,
    "description": "注文日"
  }
}
```

## 🎨 Alpine.js コンポーネント

このプロジェクトではBootstrap JSを使用せず、すべてAlpine.jsで実装しています。

### 利用可能なコンポーネント
- **サイドバートグル** (`sidebar.js`)
- **ドロップダウンメニュー** (`dropdown.js`)
- **モーダルウィンドウ** (`modal.js`)
- **トースト通知** (`toast.js`)
- **アコーディオン** (`accordion.js`)
- **タブ切り替え** (`tabs.js`)

詳細は [`docs/ALPINEJS_COMPONENTS.md`](docs/ALPINEJS_COMPONENTS.md) を参照してください。

### 使用例：モーダルウィンドウ

```html
<!-- モーダルトリガー -->
<button @click="$store.modals.open('myModal')">モーダルを開く</button>

<!-- モーダル本体 -->
<div x-data="modal()" 
     x-show="$store.modals.isOpen('myModal')"
     class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>タイトル</h5>
                <button @click="$store.modals.close()">×</button>
            </div>
            <div class="modal-body">コンテンツ</div>
        </div>
    </div>
</div>
```

### 使用例：トースト通知

```javascript
// 成功メッセージ
Alpine.store('toasts').success('保存しました！');

// エラーメッセージ
Alpine.store('toasts').error('エラーが発生しました');
```

## 🗄️ データベース

### テーブル構成
- **users** - ユーザー情報
- **categories** - カテゴリ情報（階層構造対応）
- **templates** - テンプレート本体
- **template_versions** - バージョン履歴

詳細なER図とクエリ例は [`docs/DATABASE.md`](docs/DATABASE.md) を参照してください。

## 🔒 セキュリティ

### 実装済みセキュリティ対策
- ✅ **CSRF対策**: CodeIgniter 4 の自動CSRF保護
- ✅ **SQLインジェクション対策**: クエリビルダー使用
- ✅ **XSS対策**: 自動エスケープ、`esc()` 関数
- ✅ **認証・認可**: フィルターによるアクセス制御
- ✅ **パスワードハッシュ**: `password_hash()` / `password_verify()`
- ✅ **セッション管理**: セキュアなセッション設定

### セキュリティベストプラクティス
- 本番環境では `.env` の `CI_ENVIRONMENT` を `production` に設定
- 強固な `encryption.key` を生成（`php spark key:generate`）
- データベースユーザーの最小権限設定
- HTTPS の使用を推奨

## 🧪 テスト

```bash
# PHPUnit テスト実行
composer test

# 特定のテストクラスを実行
vendor/bin/phpunit tests/unit/Models/TemplateModelTest.php
```

## 📚 ドキュメント

- [アーキテクチャ設計書](docs/ARCHITECTURE.md) - システムアーキテクチャの詳細
- [Alpine.jsコンポーネントガイド](docs/ALPINEJS_COMPONENTS.md) - コンポーネントの使用方法
- [データベース設計書](docs/DATABASE.md) - データベーススキーマとクエリ例

## 🤝 貢献

プロジェクトへの貢献を歓迎します！

1. このリポジトリをフォーク
2. 機能ブランチを作成 (`git checkout -b feature/amazing-feature`)
3. 変更をコミット (`git commit -m 'Add amazing feature'`)
4. ブランチにプッシュ (`git push origin feature/amazing-feature`)
5. プルリクエストを作成

## 📝 コーディング規約

- **PHP**: PSR-12 準拠
- **インデント**: スペース4つ
- **命名規則**: 英語（変数・関数）、日本語（コメント）
- **Alpine.js**: 宣言的アプローチ、独立性、再利用性を重視

## 🐛 トラブルシューティング

### Alpine.js が動作しない
- CDN が正しく読み込まれているか確認
- `defer` 属性が付いているか確認
- ブラウザのコンソールでエラーを確認

### マイグレーションエラー
- データベース接続情報が正しいか確認（`.env`）
- データベースが作成されているか確認
- 既存のテーブルと競合していないか確認

### 認証がうまくいかない
- セッション設定を確認（`.env` の `app.sessionDriver`）
- フィルターが正しく登録されているか確認（`Config/Filters.php`）

## 📄 ライセンス

MIT License

## 👥 作成者

CodeIgniter4 + Alpine.js テンプレート管理システム開発チーム

## 🙏 謝辞

- [CodeIgniter 4](https://codeigniter.com/)
- [Alpine.js](https://alpinejs.dev/)
- [Bootstrap 5](https://getbootstrap.com/)
- [Velzon Admin Template](https://themesbrand.com/velzon/)
