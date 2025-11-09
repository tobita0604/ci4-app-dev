# データベース設計書

## 概要
テンプレート管理システムのデータベース設計。ユーザー管理、カテゴリ管理、テンプレート管理、バージョン管理の4つの主要機能を提供。

## ER図

```
┌──────────────┐         ┌──────────────┐
│    users     │         │  categories  │
├──────────────┤         ├──────────────┤
│ id (PK)      │         │ id (PK)      │
│ username     │         │ name         │
│ email        │         │ slug         │
│ password_hash│         │ description  │
│ role         │         │ parent_id(FK)│ ─┐
│ is_active    │         │ display_order│  │
│ last_login   │         │ is_active    │  │
│ created_at   │         │ created_at   │  │
│ updated_at   │         │ updated_at   │  │
└──────┬───────┘         └──────┬───────┘  │
       │                        │          │
       │                        └──────────┘
       │                        │
       │              ┌─────────┴─────────┐
       │              │                   │
       │        ┌─────▼─────────────┐     │
       │        │    templates      │     │
       │        ├───────────────────┤     │
       │        │ id (PK)           │     │
       │        │ category_id (FK)  │─────┘
       ├────────┤ name              │
       │        │ slug              │
       │        │ type              │
       │        │ description       │
       │        │ content           │
       │        │ variables         │
       │        │ is_active         │
       │        │ version           │
       ├────────┤ created_by (FK)   │
       │        │ updated_by (FK)   │
       │        │ created_at        │
       │        │ updated_at        │
       │        └─────┬─────────────┘
       │              │
       │              │
       │        ┌─────▼──────────────────┐
       │        │  template_versions    │
       │        ├───────────────────────┤
       │        │ id (PK)               │
       │        │ template_id (FK)      │
       │        │ version_number        │
       │        │ content               │
       │        │ variables             │
       │        │ change_description    │
       └────────┤ created_by (FK)       │
                │ created_at            │
                └───────────────────────┘
```

## テーブル定義

### 1. users テーブル
**用途**: システムユーザー（管理者・一般ユーザー）の情報を管理

| カラム名 | データ型 | NULL | デフォルト | 説明 |
|---------|---------|------|----------|------|
| id | INT(11) UNSIGNED | NO | AUTO_INCREMENT | 主キー |
| username | VARCHAR(100) | NO | - | ユーザー名（ログインID） |
| email | VARCHAR(255) | NO | - | メールアドレス |
| password_hash | VARCHAR(255) | NO | - | パスワードハッシュ（bcrypt） |
| role | ENUM('admin','user','guest') | NO | 'user' | 権限レベル |
| is_active | TINYINT(1) | NO | 1 | アカウント有効フラグ |
| last_login | DATETIME | YES | NULL | 最終ログイン日時 |
| created_at | DATETIME | YES | NULL | 作成日時 |
| updated_at | DATETIME | YES | NULL | 更新日時 |

**インデックス**:
- PRIMARY KEY: `id`
- UNIQUE KEY: `username`
- UNIQUE KEY: `email`
- KEY: `role`
- KEY: `is_active`

**サンプルデータ**:
```sql
INSERT INTO users (username, email, password_hash, role, is_active, created_at) VALUES
('admin', 'admin@example.com', '$2y$10$...', 'admin', 1, NOW()),
('user1', 'user1@example.com', '$2y$10$...', 'user', 1, NOW());
```

---

### 2. categories テーブル
**用途**: テンプレートを分類するカテゴリ情報を管理（階層構造対応）

| カラム名 | データ型 | NULL | デフォルト | 説明 |
|---------|---------|------|----------|------|
| id | INT(11) UNSIGNED | NO | AUTO_INCREMENT | 主キー |
| name | VARCHAR(100) | NO | - | カテゴリ名 |
| slug | VARCHAR(100) | NO | - | URL用スラッグ（英数字） |
| description | TEXT | YES | NULL | カテゴリの説明 |
| parent_id | INT(11) UNSIGNED | YES | NULL | 親カテゴリID（自己参照） |
| display_order | INT(11) | NO | 0 | 表示順序（昇順） |
| is_active | TINYINT(1) | NO | 1 | 有効フラグ |
| created_at | DATETIME | YES | NULL | 作成日時 |
| updated_at | DATETIME | YES | NULL | 更新日時 |

**インデックス**:
- PRIMARY KEY: `id`
- UNIQUE KEY: `slug`
- KEY: `parent_id`
- KEY: `display_order`
- KEY: `is_active`

**外部キー制約**:
- `parent_id` REFERENCES `categories(id)` ON DELETE SET NULL ON UPDATE CASCADE

**サンプルデータ**:
```sql
INSERT INTO categories (name, slug, description, parent_id, display_order, created_at) VALUES
('HTMLテンプレート', 'html-templates', 'HTML形式のテンプレート', NULL, 1, NOW()),
('メールテンプレート', 'email-templates', 'メール送信用テンプレート', NULL, 2, NOW()),
('通知テンプレート', 'notification-templates', '通知メッセージ用テンプレート', NULL, 3, NOW());
```

---

### 3. templates テーブル
**用途**: テンプレート本体の情報を管理

| カラム名 | データ型 | NULL | デフォルト | 説明 |
|---------|---------|------|----------|------|
| id | INT(11) UNSIGNED | NO | AUTO_INCREMENT | 主キー |
| category_id | INT(11) UNSIGNED | YES | NULL | カテゴリID |
| name | VARCHAR(255) | NO | - | テンプレート名 |
| slug | VARCHAR(255) | NO | - | URL用スラッグ |
| type | ENUM('html','email','notification','other') | NO | 'html' | テンプレート種別 |
| description | TEXT | YES | NULL | テンプレートの説明 |
| content | LONGTEXT | YES | NULL | テンプレート本文 |
| variables | JSON | YES | NULL | テンプレート変数定義 |
| is_active | TINYINT(1) | NO | 1 | 有効フラグ |
| version | INT(11) | NO | 1 | 現在のバージョン番号 |
| created_by | INT(11) UNSIGNED | YES | NULL | 作成者ID |
| updated_by | INT(11) UNSIGNED | YES | NULL | 最終更新者ID |
| created_at | DATETIME | YES | NULL | 作成日時 |
| updated_at | DATETIME | YES | NULL | 更新日時 |

**インデックス**:
- PRIMARY KEY: `id`
- UNIQUE KEY: `slug`
- KEY: `category_id`
- KEY: `type`
- KEY: `is_active`
- KEY: `created_by`
- KEY: `updated_by`

**外部キー制約**:
- `category_id` REFERENCES `categories(id)` ON DELETE SET NULL ON UPDATE CASCADE
- `created_by` REFERENCES `users(id)` ON DELETE SET NULL ON UPDATE CASCADE
- `updated_by` REFERENCES `users(id)` ON DELETE SET NULL ON UPDATE CASCADE

**variables カラムのJSON構造例**:
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

**サンプルデータ**:
```sql
INSERT INTO templates (category_id, name, slug, type, content, variables, created_by, created_at) VALUES
(1, 'ウェルカムページ', 'welcome-page', 'html', '<h1>こんにちは、{{user_name}}さん</h1>', '{"user_name": {"type": "string", "required": true}}', 1, NOW()),
(2, '注文確認メール', 'order-confirmation', 'email', 'ご注文ありがとうございます。注文ID: {{order_id}}', '{"order_id": {"type": "integer", "required": true}}', 1, NOW());
```

---

### 4. template_versions テーブル
**用途**: テンプレートの変更履歴を保存（バージョン管理）

| カラム名 | データ型 | NULL | デフォルト | 説明 |
|---------|---------|------|----------|------|
| id | INT(11) UNSIGNED | NO | AUTO_INCREMENT | 主キー |
| template_id | INT(11) UNSIGNED | NO | - | テンプレートID |
| version_number | INT(11) | NO | - | バージョン番号 |
| content | LONGTEXT | YES | NULL | このバージョンの本文 |
| variables | JSON | YES | NULL | このバージョンの変数定義 |
| change_description | TEXT | YES | NULL | 変更内容の説明 |
| created_by | INT(11) UNSIGNED | YES | NULL | このバージョンの作成者 |
| created_at | DATETIME | YES | NULL | 作成日時 |

**インデックス**:
- PRIMARY KEY: `id`
- KEY: `template_id`, `version_number` (複合キー)
- KEY: `created_by`

**外部キー制約**:
- `template_id` REFERENCES `templates(id)` ON DELETE CASCADE ON UPDATE CASCADE
- `created_by` REFERENCES `users(id)` ON DELETE SET NULL ON UPDATE CASCADE

**サンプルデータ**:
```sql
INSERT INTO template_versions (template_id, version_number, content, change_description, created_by, created_at) VALUES
(1, 1, '<h1>こんにちは、{{user_name}}さん</h1>', '初版作成', 1, NOW()),
(1, 2, '<h1>ようこそ、{{user_name}}さん！</h1>', '挨拶文を変更', 1, NOW());
```

---

## マイグレーション実行

### マイグレーション実行順序
1. `CreateUsersTable` - ユーザーテーブル
2. `CreateCategoriesTable` - カテゴリテーブル
3. `CreateTemplatesTable` - テンプレートテーブル
4. `CreateTemplateVersionsTable` - バージョンテーブル

### 実行コマンド
```bash
# すべてのマイグレーションを実行
php spark migrate

# 特定のマイグレーションを実行
php spark migrate -n 1

# マイグレーションをロールバック
php spark migrate:rollback

# マイグレーション状態の確認
php spark migrate:status
```

## シード実行

### シーダー実行順序
1. `UserSeeder` - 管理者・テストユーザー作成
2. `CategorySeeder` - カテゴリ作成
3. `TemplateSeeder` - サンプルテンプレート作成

### 実行コマンド
```bash
# すべてのシーダーを実行
php spark db:seed DatabaseSeeder

# 特定のシーダーを実行
php spark db:seed UserSeeder
php spark db:seed CategorySeeder
php spark db:seed TemplateSeeder
```

## クエリ例

### 1. カテゴリ別テンプレート一覧取得
```sql
SELECT 
    t.id,
    t.name,
    t.slug,
    t.type,
    c.name AS category_name,
    u.username AS created_by_name,
    t.created_at
FROM templates t
LEFT JOIN categories c ON t.category_id = c.id
LEFT JOIN users u ON t.created_by = u.id
WHERE t.is_active = 1
  AND c.slug = 'html-templates'
ORDER BY t.created_at DESC;
```

### 2. テンプレートとその全バージョン取得
```sql
SELECT 
    t.id,
    t.name,
    t.version AS current_version,
    tv.version_number,
    tv.change_description,
    tv.created_at AS version_created_at,
    u.username AS version_author
FROM templates t
LEFT JOIN template_versions tv ON t.id = tv.template_id
LEFT JOIN users u ON tv.created_by = u.id
WHERE t.id = 1
ORDER BY tv.version_number DESC;
```

### 3. 階層カテゴリ取得（親子関係）
```sql
SELECT 
    c1.id,
    c1.name,
    c1.slug,
    c2.name AS parent_name,
    c1.display_order
FROM categories c1
LEFT JOIN categories c2 ON c1.parent_id = c2.id
WHERE c1.is_active = 1
ORDER BY c1.display_order ASC;
```

### 4. ユーザー別テンプレート作成数
```sql
SELECT 
    u.username,
    u.email,
    COUNT(t.id) AS template_count
FROM users u
LEFT JOIN templates t ON u.id = t.created_by
WHERE u.is_active = 1
GROUP BY u.id, u.username, u.email
ORDER BY template_count DESC;
```

## バックアップとリストア

### バックアップ
```bash
# データベース全体のバックアップ
mysqldump -u username -p database_name > backup_$(date +%Y%m%d).sql

# 特定のテーブルのみバックアップ
mysqldump -u username -p database_name templates template_versions > templates_backup.sql
```

### リストア
```bash
# バックアップからリストア
mysql -u username -p database_name < backup_20251109.sql
```

## パフォーマンスチューニング

### インデックス最適化
```sql
-- よく使用されるクエリに対するインデックス追加例
CREATE INDEX idx_templates_category_type ON templates(category_id, type);
CREATE INDEX idx_templates_created_at ON templates(created_at);
CREATE INDEX idx_template_versions_template_version ON template_versions(template_id, version_number);
```

### クエリ最適化のポイント
1. **N+1問題の回避**: JOIN を使用して1回のクエリで取得
2. **適切なインデックス**: WHERE, JOIN, ORDER BY で使用されるカラムにインデックス
3. **LIMIT 使用**: 大量データは必ずページネーション
4. **SELECT *を避ける**: 必要なカラムのみ SELECT

---

**最終更新**: 2025-11-09
