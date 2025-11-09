# 環境構築手順（CodeIgniter 4 + Vue.js + 主要PHPライブラリ + Tailwind CSS/Preline）

## 概要

本プロジェクトでは以下の技術スタックを使用します。

- バックエンド：CodeIgniter 4
- フロントエンド：Vue.js（jQueryは使用せず、Vue.jsで動的UIを実装）
- スタイル/UI：Tailwind CSS + Preline（Tailwind CSSベースUIコンポーネントライブラリ）
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

- PHP 8.0 以上（推奨: 8.1+）
- Composer 最新版
- Node.js & npm（Vue.js, Tailwind CSS, Preline利用のため）

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

## 5. フロントエンド（Vue.js + Tailwind CSS + Preline）セットアップ

### 5-1. Vue.jsセットアップ

#### CDN利用（シンプルな構成の場合）

HTMLテンプレートで直接Vue.jsを読み込みます。

```html
<script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
```

#### npm利用（ビルドや拡張開発を行う場合）

```bash
npm init -y
npm install vue@3
npm install axios # API通信を行う場合
```

- `public/`や`resources/js/`配下にVueコンポーネントを配置し、必要に応じてビルドツール（ViteやWebpackなど）を導入してください。

### 5-2. Tailwind CSS & Preline セットアップ（npm利用想定）

```bash
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
npm install preline
```

#### `tailwind.config.js` の設定例
```js
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
    "./node_modules/preline/dist/*.js",
    // 必要に応じてCodeIgniterのViewのパスも追加
    "../app/Views/**/*.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

#### Tailwind CSS を `src/index.css` などに追加
```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

#### Preline を JavaScriptエントリポイントでimport
```js
// 例: src/main.js
import 'preline'
```

#### Vueコンポーネント内でPreline UIを利用する場合
- PrelineのJavaScript初期化はVueのライフサイクルフック（onMountedなど）で行う
```vue
<template>
  <button data-hs-overlay="#modal">Open Modal</button>
  <div id="modal" class="hs-overlay ...">...</div>
</template>
<script setup>
import { onMounted } from 'vue'
import 'preline'

onMounted(() => {
  window.HSOverlay?.init()
})
</script>
```

#### Tailwind/Prelineのビルド
```bash
npx tailwindcss -i ./src/index.css -o ./public/css/tailwind.css --minify
```
- 必要に応じてビルドツールやnpm scriptsを利用

---

## 6. jQueryの代わりにVue.jsを利用

- 動的な画面操作やAjax通信は、全てVue.js（およびaxios等）で実装してください。
- 必要に応じてページ単位やコンポーネント単位でVueを導入可能です。
- UIコンポーネントにはPreline（Tailwind CSSベース）を活用できます。

---

## 7. 主要PHPライブラリの利用について

- ExcelやPDFの生成/編集・高度なキャッシュ機能などは、CodeIgniter 4のコントローラーやサービスクラスで各ライブラリを直接利用してください。
- バックエンドでファイルを生成し、必要に応じてAPI経由でフロントエンド（Vue.js）と連携してください。

---

## 参考ドキュメント

- [CodeIgniter 4 公式](https://codeigniter4.github.io/userguide/)
- [Vue.js 公式](https://jp.vuejs.org/)
- [Tailwind CSS 公式](https://tailwindcss.com/)
- [Preline 公式](https://preline.co/)
- [phpspreadsheet ドキュメント](https://phpspreadsheet.readthedocs.io/)
- [TCPDF 公式](https://tcpdf.org/)
- [FPDI 公式](https://www.setasign.com/products/fpdi/about/)
- [Symfony Cache ドキュメント](https://symfony.com/doc/current/components/cache.html)

---

## 備考

- 詳細な実装例や設計方針が必要な場合はチームで都度共有・相談してください。
- PrelineをVueコンポーネント内で利用する際は、JavaScriptの初期化タイミングやリアクティブな状態との整合性に注意してください。