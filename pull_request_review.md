## 修正が必要です

このPRは**テンプレート管理システム**を構築していますが、Issue #3で要求されている**レガシーシステム（axaepc + axadb_2025.sql）の移行**とは異なる内容になっています。

### 問題点

#### 1. データベーススキーマが異なる
現在のPR: `users`, `categories`, `templates`, `template_versions`の4テーブル

必要なテーブル（axadb_2025.sqlより）:
- `c00_charger` - 担当者管理（営業担当者、オーガナイザー、管理者）
- `r01_reserver` - 予約者情報（ログイン、支社コード、招待枠管理）
- `r01_member` - メンバー情報（氏名、パスポート、ESTA、住所、緊急連絡先）
- `r01_car_rental` - レンタカー予約情報
- `r01_note` - 備考情報
- `r02_option` - オプションツアー情報（ファーム、ゴルフ、各種アクティビティ）
- `r02_car_rental_stock` - レンタカー在庫管理
- `m01_option` - オプションマスタ（ツアー名、価格、営業時間、催行時間）
- `m01_option_available` - オプション利用可能期間
- `m01_option_time` - オプション時間別在庫管理
- `r01_reserver_backup` - 予約者バックアップ
- `r01_reserver_testdata` - テストデータ
- `r03_admin_ip` - 管理者IP制限

**全13テーブルのマイグレーションが必要です。**

#### 2. ビジネスロジックが異なる
レガシーシステムは**旅行・ツアー予約管理システム**です。以下の機能が必要：

**必須機能:**
- 予約者管理（ログイン認証、支社別管理、招待枠管理）
- メンバー情報管理（参加者の個人情報、パスポート情報、ESTA）
- オプションツアー予約（ファーム見学、ゴルフ、各種アクティビティ）
- レンタカー予約（在庫管理、予約管理、運転免許証情報）
- 管理者機能（担当者管理、IP制限、バックアップ）

#### 3. axaepcディレクトリの内容が反映されていない
レガシーPHPファイル（コントローラー・モデル）の機能を新CI4構造に再設計する必要があります。

### 修正依頼内容

1. **axadb_2025.sqlの全テーブルをマイグレーションで再現**
   - 13テーブルすべてのCREATE文
   - 主キー、インデックスの定義
   - 文字コード（utf8/utf8mb4）の適切な設定

2. **旅行予約システムの機能実装**
   ``
   Controllers/Admin/
   ├── ReserverController.php      # 予約者管理
   ├── MemberController.php        # メンバー情報管理
   ├── OptionController.php        # オプションツアー管理
   ├── CarRentalController.php     # レンタカー管理
   └── ChargerController.php       # 担当者管理
   
   Models/
   ├── ReserverModel.php
   ├── MemberModel.php
   ├── OptionModel.php
   ├── CarRentalModel.php
   └── ChargerModel.php
   
   Services/
   ├── ReservationService.php      # 予約ビジネスロジック
   ├── OptionService.php           # オプション在庫管理
   └── CarRentalService.php        # レンタカー在庫管理
   ``

3. **axaepcディレクトリのPHPファイルを参照して機能を移植**

4. **Alpine.jsコンポーネントは維持**（この部分は良好です）
   - サイドバートグル ✅
   - ドロップダウンメニュー ✅
   - モーダルウィンドウ ✅
   - トースト通知 ✅
   - アコーディオン ✅
   - タブ切り替え ✅

### 参考

`.github/copilot-instructions.md`のプロジェクト構成に従い、Bootstrap 5 + Velzonテンプレート + Alpine.jsで実装してください。

レガシーシステムの詳細は以下のファイルを参照：
- `axadb_2025.sql` - データベーススキーマ
- `axaepc/` - レガシーPHPファイル