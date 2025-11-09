# Velzon テンプレート移行ガイド

## 概要

このドキュメントでは、レガシーのVelzon_tempフォルダからCodeIgniter 4.6.1環境へのVelzon管理画面テンプレートの移行について詳しく説明します。

## 移行概要

### 移行元環境
- **フレームワーク**: CodeIgniter 4（旧バージョン）
- **PHP**: 7.4/8.0
- **場所**: `Velzon_temp/` ディレクトリ
- **ステータス**: レガシーテンプレートコード

### 移行先環境  
- **フレームワーク**: CodeIgniter 4.6.1
- **PHP**: 8.3
- **場所**: メインの`app/`および`public/`ディレクトリに統合
- **ステータス**: 本番環境対応済み

## 実施した変更

### 1. アセットの移行

すべての静的アセットを`Velzon_temp/public/assets/`から`public/assets/`にコピー：

```
public/assets/
├── css/         (Bootstrap、アプリスタイル、アイコン)
├── js/          (カスタムJavaScript)
├── libs/        (50以上のベンダーライブラリ)
├── images/      (ロゴ、背景、アイコン)
├── fonts/       (アイコンフォント、Webフォント)
├── scss/        (ソースSCSSファイル)
├── json/        (データファイル)
└── lang/        (多言語対応)
```

**合計サイズ**: 約140MB

### 2. ビューファイル

CI4.6.1互換性を持つ新しい管理画面ビュー構造を作成：

#### メインダッシュボード
- `app/Views/admin/dashboard.php` - メインダッシュボードページ

#### パーシャル（レイアウトコンポーネント）
```
app/Views/admin/partials/
├── main.php              (HTMLドキュメントルート)
├── title-meta.php        (メタタグ、タイトル)
├── head-css.php          (CSS読み込み)
├── menu.php              (メニューラッパー)
├── topbar.php            (トップナビゲーション - 731行)
├── sidebar.php           (サイドバーナビゲーション - 1268行)
├── footer.php            (フッターコンポーネント)
├── vendor-scripts.php    (JS読み込み)
├── page-title.php        (パンくずリスト/タイトル)
└── customizer.php        (テーマカスタマイザー)
```

#### ビューの主な更新点

**変更前（Velzon_temp）**:
```php
<?= $this->include('partials/main') ?>
<link href="/assets/css/app.min.css" />
<title><?= ($title) ? $title : '' ?></title>
```

**変更後（CI4.6.1）**:
```php
<?= $this->include('admin/partials/main') ?>
<link href="<?= base_url('assets/css/app.min.css') ?>" />
<title><?= esc($title ?? 'Dashboard') ?></title>
```

### 3. コントローラー

PHP 8.3機能を使用した新しいAdminコントローラー名前空間を作成：

**ファイル**: `app/Controllers/Admin/DashboardController.php`

```php
<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Dashboard',
            'pagetitle' => 'Dashboards',
        ];

        return view('admin/dashboard', $data);
    }

    public function analytics(): string
    {
        // 実装...
    }
}
```

**使用したPHP 8.3機能**:
- 戻り値の型宣言（`: string`）
- パラメータの型ヒント
- PHPDocコメント
- 名前空間の整理

### 4. ルート設定

**ファイル**: `app/Config/Routes.php`

```php
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
    $routes->get('', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('dashboard/analytics', 'DashboardController::analytics');
});
```

**機能**:
- 管理画面セクションのルートグループ化
- 名前空間ルーティング
- クリーンなURL構造

### 5. セキュリティ強化

#### 出力のエスケープ
すべての動的出力に`esc()`ヘルパーを使用：
```php
<title><?= esc($title ?? 'Dashboard') ?></title>
```

#### アセットパスのセキュリティ
すべてのアセットパスに`base_url()`を使用：
```php
<link href="<?= base_url('assets/css/app.min.css') ?>" />
```

#### 型安全性
コントローラーで厳密な型付けを使用：
```php
public function index(): string
{
    // 型安全な実装
}
```

## フレームワーク互換性の更新

### ビュー構文の変更

| 旧（Velzon_temp） | 新（CI4.6.1） | 理由 |
|-------------------|---------------|--------|
| `$this->include('partials/...')` | `$this->include('admin/partials/...')` | 適切な名前空間の分離 |
| `view('partials/title-meta', array('title'=>'X'))` | `view('admin/partials/title-meta', ['title' => 'X'])` | モダンな配列構文 |
| `/assets/` | `base_url('assets/')` | フレームワークヘルパーの使用 |
| `<?= $title ?>` | `<?= esc($title) ?>` | XSS対策 |

### ヘルパー関数

| ヘルパー | 使用方法 | 目的 |
|--------|-------|---------|
| `base_url()` | `base_url('assets/css/app.css')` | 完全なアセットURLを生成 |
| `esc()` | `esc($user_input)` | XSS対策のための出力エスケープ |
| `view()` | `view('admin/dashboard', $data)` | データを含むビューのレンダリング |

## テスト結果

### 開発サーバー
```bash
cd ci4-app
php spark serve --host=0.0.0.0 --port=8080
```

✅ **サーバーステータス**: 正常に動作中
✅ **管理画面URL**: http://localhost:8080/admin
✅ **ページ読み込み**: 成功（200 OK）
✅ **アセット読み込み**: すべてのCSS、JS、画像が正常に読み込まれる
✅ **レイアウトレンダリング**: サイドバー、トップバー、フッターを含む完全なレイアウト

### セキュリティチェック

✅ **危険な関数なし**（eval、exec、systemなど）
✅ **スーパーグローバル変数の直接使用なし**（$_GET、$_POSTなど）
✅ **出力のエスケープ** esc()で実装
✅ **型安全性** コントローラーで強制
✅ **CSRF保護**（CodeIgniterデフォルト）

## ディレクトリ構造

```
ci4-app/
├── app/
│   ├── Config/
│   │   └── Routes.php                 (管理画面ルートを追加)
│   ├── Controllers/
│   │   └── Admin/
│   │       └── DashboardController.php
│   └── Views/
│       └── admin/
│           ├── dashboard.php
│           └── partials/
│               ├── main.php
│               ├── title-meta.php
│               ├── head-css.php
│               ├── menu.php
│               ├── topbar.php
│               ├── sidebar.php
│               ├── footer.php
│               ├── vendor-scripts.php
│               ├── page-title.php
│               └── customizer.php
└── public/
    └── assets/
        ├── css/
        ├── js/
        ├── libs/
        ├── images/
        ├── fonts/
        ├── scss/
        ├── json/
        └── lang/
```

## 含まれるライブラリ

テンプレートには50以上のJavaScript/CSSライブラリが含まれています：

- **UIフレームワーク**: Bootstrap 5
- **チャート**: ApexCharts、Chart.js、ECharts
- **アイコン**: Feather Icons、Boxicons、Material Design Icons、Remix Icons
- **フォーム**: Choices.js、Flatpickr、Cleave.js
- **リッチテキスト**: CKEditor、Quill、Summernote
- **ファイルアップロード**: Dropzone、Filepond
- **データテーブル**: DataTables、GridJS、List.js
- **地図**: Leaflet、JSVectorMap
- **ユーティリティ**: Swiper、SweetAlert2、Toastify
- その他多数...

## 新しい管理画面ページの追加方法

新しい管理画面ページを追加するには：

1. **ビューファイルの作成**:
```php
// app/Views/admin/new-page.php
<?= $this->include('admin/partials/main') ?>
<head>
    <?= view('admin/partials/title-meta', ['title' => 'New Page']) ?>
    <?= $this->include('admin/partials/head-css') ?>
</head>
<body>
    <div id="layout-wrapper">
        <?= $this->include('admin/partials/menu') ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- ここにコンテンツを追加 -->
                </div>
            </div>
            <?= $this->include('admin/partials/footer') ?>
        </div>
    </div>
    <?= $this->include('admin/partials/vendor-scripts') ?>
</body>
</html>
```

2. **コントローラーメソッドの追加**:
```php
// app/Controllers/Admin/DashboardController.php
public function newPage(): string
{
    return view('admin/new-page', [
        'title' => 'New Page'
    ]);
}
```

3. **ルートの追加**:
```php
// app/Config/Routes.php (adminグループ内)
$routes->get('new-page', 'DashboardController::newPage');
```

## バージョン間の違い

### Velzon_temp（旧）
- PHP 7.4/8.0
- 古いCI4バージョン
- 直接のアセットパス（`/assets/`）
- 配列構文：`array('key' => 'value')`
- 型ヒントなし

### 現在（新）
- PHP 8.3
- CodeIgniter 4.6.1
- ヘルパーベースのパス（`base_url('assets/')`）
- モダンな配列構文：`['key' => 'value']`
- 完全な型安全性

## トラブルシューティング

### アセットが読み込まれない
- `.env`ファイルの`app.baseURL`を確認
- publicフォルダの権限を確認
- アセットが`public/assets/`にあることを確認

### ビューが見つからない
- ビューパスに`admin/`プレフィックスが含まれているか確認
- `app/Views/admin/`にファイルが存在するか確認
- ファイルの権限を確認

### コントローラーが見つからない
- Routes.phpで名前空間を確認
- コントローラークラス名がファイル名と一致しているか確認
- PSR-4オートローディングが機能しているか確認

## メンテナンス

### アセットの更新
CSS/JSライブラリを更新するには：
1. 新しいバージョンをダウンロード
2. `public/assets/libs/[library]/`のファイルを置き換え
3. 必要に応じてバージョン参照を更新
4. 徹底的にテスト

### カスタムCSS/JSの追加
1. `public/assets/css/`または`public/assets/js/`にファイルを追加
2. `base_url()`を使用してビューファイルに含める
3. または`head-css.php`/`vendor-scripts.php`パーシャルに追加

## まとめ

VelzonテンプレートはCodeIgniter 4.6.1に正常に移行され、PHP 8.3との完全な互換性を持っています。すべてのアセット、ビュー、コントローラー、ルートが適切に構造化され、セキュリティと保守性に関するモダンなベストプラクティスに従っています。

管理画面ダッシュボードは`/admin`でアクセス可能で、包括的な管理インターフェースを構築するための強固な基盤を提供します。
