# 環境構築手順（CodeIgniter 4 + Alpine.js + 主要PHPライブラリ + Velzon）

## 概要

本プロジェクトでは以下の技術スタックを使用します。

- バックエンド：CodeIgniter 4
- フロントエンド：Alpine.js（jQueryは使用せず、Alpine.jsで動的UIを実装）
- スタイル/UI：Bootstrap 5 + Velzon（Bootstrap 5ベース管理画面テンプレート）
- 主要PHPライブラリ（Composer管理）：
    - `phpoffice/phpspreadsheet`（Excelファイル操作）
    - `symfony/cache`（キャッシュ機能）
    - `tecnickcom/tcpdf`（PDF生成）
    - `setasign/fpdi`（PDF編集・合成）
- 管理画面テンプレート
    - デモサイト：https://themesbrand.com/velzon/codeigniter.html
    - ダウンロードURL：https://themeforest.net
    
---

## 前提条件

- PHP 8.3 以上
- Composer 最新版
- Node.js & npm（Alpine.js, Bootstrap 5利用のため）

---

## 1. プロジェクトディレクトリの作成

```bash
mkdir <プロジェクトディレクトリ名>
cd <プロジェクトディレクトリ名>
```

---

## 2. CodeIgniter 4 プロジェクトの作成

```bash
composer create-project codeigniter4/appstarter .
```

---

## 3. PHP依存パッケージのインストール

```bash
composer require phpoffice/phpspreadsheet:1.29 symfony/cache:^6.0 tecnickcom/tcpdf:^6.9 setasign/fpdi:^2.6
```

---

## 4. CodeIgniter 4 の設定

- `.env` ファイルを `.env.example` からコピーして作成し、必要な環境変数を設定
- `app/Config/App.php` や `app/Config/Database.php` を用途に合わせて調整
- ルーティングは `app/Config/Routes.php` で設定

---

## 5. フロントエンド（Alpine.js + Bootstrap 5）セットアップ

### 5-1. Alpine.jsセットアップ

#### CDN利用（推奨）

HTMLテンプレートで直接Alpine.jsを読み込みます。

```html
<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

#### npm利用（ビルドや拡張開発を行う場合）

```bash
npm init -y
npm install alpinejs
npm install axios # API通信を行う場合
```

```js
// main.js
import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()
```

### 5-2. Bootstrap 5 セットアップ

Bootstrap 5はVelzonテンプレートに既に含まれています。

```html
<!-- Bootstrap 5 CSS -->
<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

<!-- Bootstrap 5 JS -->
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
```

#### Alpine.jsとBootstrapの統合例
```html
<div x-data="{ open: false }">
    <button @click="open = !open" class="btn btn-primary">
        トグル
    </button>
    <div x-show="open" class="alert alert-info mt-2">
        Alpine.jsとBootstrap 5の組み合わせ
    </div>
</div>
```

---

## 6. jQueryの代わりにAlpine.jsを利用

- 動的な画面操作やAjax通信は、全てAlpine.js（およびaxios等）で実装してください。
- Alpine.jsは軽量で、HTMLに直接ディレクティブを記述できるため、既存のHTMLに段階的に導入可能です。
- UIコンポーネントにはBootstrap 5を活用し、動的な振る舞いにAlpine.jsを使用します。

### Alpine.jsの基本的な使い方

```html
<!-- データバインディング -->
<div x-data="{ count: 0 }">
    <button @click="count++" class="btn btn-primary">カウント: <span x-text="count"></span></button>
</div>

<!-- 条件表示 -->
<div x-data="{ show: true }">
    <button @click="show = !show" class="btn btn-secondary">表示切替</button>
    <p x-show="show" class="mt-2">表示されています</p>
</div>

<!-- API通信 -->
<div x-data="{ users: [] }" x-init="fetch('/api/users').then(r => r.json()).then(data => users = data)">
    <template x-for="user in users" :key="user.id">
        <div x-text="user.name"></div>
    </template>
</div>
```

---

## 7. 主要PHPライブラリの利用について

- ExcelやPDFの生成/編集・高度なキャッシュ機能などは、CodeIgniter 4のコントローラーやサービスクラスで各ライブラリを直接利用してください。
- バックエンドでファイルを生成し、必要に応じてAPI経由でフロントエンド（Vue.js）と連携してください。

---

## 参考ドキュメント

- [CodeIgniter 4 公式](https://codeigniter4.github.io/userguide/)
- [Alpine.js 公式](https://alpinejs.dev/)
- [Bootstrap 5 公式](https://getbootstrap.jp/)
- [Velzon テンプレート](https://themesbrand.com/velzon/codeigniter.html)
- [phpspreadsheet ドキュメント](https://phpspreadsheet.readthedocs.io/)
- [TCPDF 公式](https://tcpdf.org/)
- [FPDI 公式](https://www.setasign.com/products/fpdi/about/)
- [Symfony Cache ドキュメント](https://symfony.com/doc/current/components/cache.html)

---

## 備考

- 詳細な実装例や設計方針が必要な場合はチームで都度共有・相談してください。
- Alpine.jsをBootstrapコンポーネント内で利用する際は、Bootstrapのデータ属性との競合に注意してください。
- Alpine.jsは軽量でHTMLに直接記述できるため、既存のVelzonテンプレートに段階的に導入できます。

---

## 備考

- 詳細な実装例や設計方針が必要な場合はチームで都度共有・相談してください。
- PrelineをVueコンポーネント内で利用する際は、JavaScriptの初期化タイミングやリアクティブな状態との整合性に注意してください。