# 旅行予約システム - プロジェクト概要

## 🎯 プロジェクト目的
このプロジェクトは、CodeIgniter 4フレームワークを使用した旅行予約管理システムです。
家族招待キャンペーンの旅行予約をオンラインで簡単に行えるシステムを提供します。

## 📋 システム機能

### 1. 予約者管理
- ログイン認証機能
- 支社別管理
- 招待枠管理（無料枠・有料枠）
- 予約履歴管理

### 2. メンバー情報管理
- 参加者情報の登録・編集
- パスポート情報管理
- ESTA情報管理
- 緊急連絡先情報

### 3. オプションツアー予約
- ファーム見学予約
- ゴルフ予約
- 日時別・時間帯別予約
- 在庫管理機能

### 4. レンタカー予約
- クラス別レンタカー選択
- 在庫管理
- 運転免許証情報管理
- 保険・チャイルドシート選択

### 5. 管理者機能
- 担当者アカウント管理
- IPアドレス制限
- データバックアップ機能
- 予約データ閲覧・編集

## 🛠 技術スタック

### バックエンド
- **フレームワーク**: CodeIgniter 4.x
- **PHP**: 7.4以上
- **データベース**: MySQL/MariaDB
- **アーキテクチャ**: MVC + Service層

### フロントエンド
- **JavaScript**: Alpine.js 3.x（jQueryは使用しない）
- **CSS**: Bootstrap 5
- **テンプレート**: Velzon Admin Template
- **アイコン**: Remix Icon

### 主要ライブラリ（Composer）
- `phpoffice/phpspreadsheet` - Excelファイル操作
- `symfony/cache` - キャッシュ機能
- `tecnickcom/tcpdf` - PDF生成
- `setasign/fpdi` - PDF編集・合成

## 📁 プロジェクト構造

```
ci4-app/
├── app/
│   ├── Controllers/
│   │   ├── Admin/              # 管理画面コントローラー
│   │   │   ├── Auth/           # 認証（ログイン・ログアウト）
│   │   │   ├── Reserver/       # 予約者管理
│   │   │   ├── Member/         # メンバー管理
│   │   │   ├── Option/         # オプション管理
│   │   │   ├── CarRental/      # レンタカー管理
│   │   │   └── DashboardController.php
│   │   └── Front/              # フロント画面コントローラー
│   │       ├── Auth/           # 認証（ログイン・登録）
│   │       ├── Reservation/    # 予約フロー
│   │       └── Home.php
│   │
│   ├── Models/                 # データベースモデル
│   │   ├── Reserver/
│   │   ├── Option/
│   │   ├── CarRental/
│   │   ├── ChargerModel.php
│   │   └── AdminIpModel.php
│   │
│   ├── Services/               # ビジネスロジック層
│   │   ├── Reservation/
│   │   ├── Option/
│   │   ├── CarRental/
│   │   └── Auth/
│   │
│   ├── Views/                  # ビューテンプレート
│   │   ├── admin/              # 管理画面ビュー
│   │   │   ├── auth/
│   │   │   ├── reserver/
│   │   │   ├── member/
│   │   │   ├── option/
│   │   │   ├── car_rental/
│   │   │   └── partials/
│   │   └── front/              # フロント画面ビュー
│   │       ├── home/
│   │       ├── auth/
│   │       ├── reservation/
│   │       └── layouts/
│   │
│   ├── Filters/                # アクセス制御フィルター
│   │   ├── AdminAuthFilter.php
│   │   └── FrontAuthFilter.php
│   │
│   ├── Database/
│   │   └── Migrations/         # 13テーブルのマイグレーション
│   │
│   └── Config/
│       ├── Routes.php          # ルーティング設定
│       └── Filters.php         # フィルター設定
│
├── public/                     # 公開ディレクトリ
│   ├── admin/                  # 管理画面アセット
│   │   ├── css/
│   │   ├── js/
│   │   │   └── alpinejs/       # Alpine.jsコンポーネント
│   │   └── images/
│   ├── front/                  # フロント画面アセット
│   │   ├── css/
│   │   ├── js/
│   │   │   └── alpinejs/
│   │   └── images/
│   └── assets/                 # 共通アセット（Velzonテンプレート）
│
├── writable/                   # 書き込み可能ディレクトリ
│   ├── logs/
│   ├── cache/
│   └── session/
│
├── vendor/                     # Composerパッケージ
├── axadb_2025.sql             # データベーススキーマ（参照用）
└── axaepc/                     # レガシーコード（参照のみ、使用禁止）
```

## 🗄 データベース構造（13テーブル）

### 担当者・管理者
1. **chargers** - 担当者管理テーブル

### 予約者関連
2. **reservers** - 予約者情報
3. **members** - メンバー情報
4. **notes** - 備考情報
5. **reserver_backups** - 予約者バックアップ
6. **reserver_testdata** - テストデータ

### オプションツアー関連
7. **option_reservations** - オプションツアー予約
8. **option_masters** - オプションマスタ
9. **option_availables** - オプション利用可能期間
10. **option_times** - オプション時間別在庫

### レンタカー関連
11. **car_rentals** - レンタカー予約
12. **car_rental_stocks** - レンタカー在庫

### セキュリティ
13. **admin_ips** - 管理者IP制限

## 🚀 セットアップ

### 1. 環境要件
- PHP 7.4以上
- MySQL 5.7以上 / MariaDB 10.3以上
- Composer 2.x
- Apache/Nginx

### 2. インストール手順

```bash
# リポジトリのクローン
git clone https://github.com/tobita0604/ci4-app-dev.git
cd ci4-app-dev/ci4-app

# Composerパッケージのインストール
composer install

# 環境設定ファイルのコピー
cp env .env

# .envファイルを編集してデータベース設定を行う
# CI_ENVIRONMENT = development
# database.default.hostname = localhost
# database.default.database = axadb_2025
# database.default.username = your_username
# database.default.password = your_password

# データベースマイグレーション実行
php spark migrate

# 開発サーバー起動
php spark serve
```

### 3. アクセスURL
- **フロント画面**: http://localhost:8080/
- **管理画面**: http://localhost:8080/admin/auth/login

## 🔒 セキュリティ機能

### 実装済み
- ✅ CSRF保護（すべてのフォーム）
- ✅ XSS対策（esc()ヘルパー使用）
- ✅ SQLインジェクション対策（Query Builder使用）
- ✅ IPアドレス制限（管理画面）
- ✅ パスワードハッシュ化対応
- ✅ セキュアヘッダー設定
- ✅ セッションセキュリティ

### セキュリティ設定
- 管理画面アクセスにはIP制限機能
- セッションタイムアウト設定
- パスワードポリシー（8文字以上）

## 📝 コーディング規約

### PHP
- PSR-12準拠
- インデント: スペース4つ
- 変数名・関数名: 英語
- コメント: 日本語
- すべてのクラス・メソッドにPHPDocs記述

### Alpine.js
- jQueryは使用禁止
- x-data, x-show, x-if等のディレクティブを使用
- シンプルな実装を優先
- 各ページに独立したコンポーネント関数

### CSS
- Bootstrap 5ユーティリティクラス優先
- カスタムCSSは最小限に
- Velzonテーマコンポーネント活用

## 🧪 テスト

```bash
# PHPUnitテスト実行
composer test

# 特定のテストグループ実行
vendor/bin/phpunit --group=reservation
```

## 📖 開発ガイドライン

### 新機能追加時の注意点
1. MVCパターンを遵守
2. ビジネスロジックはService層に配置
3. バリデーションは適切に実装
4. エラーハンドリングを忘れずに
5. セキュリティを常に考慮

### レガシーコード参照時の注意
- `axaepc/`ディレクトリのコードは参照のみ
- コピー・流用は禁止
- 機能要件の理解のために閲覧可能

## 🐛 トラブルシューティング

### よくある問題

**問題**: マイグレーションエラー
```bash
# マイグレーションをロールバック
php spark migrate:rollback

# 再度実行
php spark migrate
```

**問題**: 権限エラー
```bash
# writable/ディレクトリの権限設定
chmod -R 777 writable/
```

**問題**: Composerパッケージエラー
```bash
# キャッシュクリア
composer clear-cache

# 再インストール
composer install
```

## 📚 参考リンク

- [CodeIgniter 4 公式ドキュメント](https://codeigniter.com/user_guide/)
- [Alpine.js 公式ドキュメント](https://alpinejs.dev/)
- [Bootstrap 5 公式ドキュメント](https://getbootstrap.com/docs/5.0/)
- [PSR-12 コーディング規約](https://www.php-fig.org/psr/psr-12/)

## 👥 貢献

プロジェクトへの貢献は歓迎します。プルリクエストを送信する前に：

1. コーディング規約を確認
2. テストを実行
3. セキュリティチェックを実施
4. PHPDocsを適切に記述

## 📄 ライセンス

このプロジェクトは社内専用システムです。

## 📞 サポート

問題が発生した場合は、以下にご連絡ください：
- プロジェクト管理者: tobita0604
- GitHub Issues: https://github.com/tobita0604/ci4-app-dev/issues

---

**最終更新日**: 2025-11-11
**バージョン**: 1.0.0
**ステータス**: 開発中
