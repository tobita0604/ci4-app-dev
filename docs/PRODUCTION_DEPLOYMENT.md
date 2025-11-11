# 本番環境デプロイガイド

## 前提条件

- Apache 2.4以上
- PHP 8.1以上
- MySQL 5.7以上
- mod_rewriteモジュールが有効

## デプロイ手順

### 1. ファイルのアップロード

プロジェクトディレクトリ全体をサーバーにアップロードします。

```bash
# 例: /var/www/html/ci4-app にアップロード
/var/www/html/ci4-app/
├── ci4-app/
│   ├── .htaccess          # プロジェクトルート用（publicへのリダイレクト設定）
│   ├── app/
│   ├── public/
│   │   └── .htaccess      # URL書き換え設定（index.php除去）
│   ├── writable/
│   ├── vendor/
│   └── ...
```

### 2. DocumentRootの設定

**推奨**: DocumentRootを`public`ディレクトリに設定

```apache
<VirtualHost *:80>
    ServerName example.com
    DocumentRoot /var/www/html/ci4-app/ci4-app/public
    
    <Directory /var/www/html/ci4-app/ci4-app/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/ci4-app-error.log
    CustomLog ${APACHE_LOG_DIR}/ci4-app-access.log combined
</VirtualHost>
```

**代替案**: DocumentRootが`ci4-app`の場合

`ci4-app/.htaccess`が自動的に`public/`ディレクトリへリダイレクトします。
この場合、以下の設定を使用してください：

```apache
<VirtualHost *:80>
    ServerName example.com
    DocumentRoot /var/www/html/ci4-app/ci4-app
    
    <Directory /var/www/html/ci4-app/ci4-app>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    <Directory /var/www/html/ci4-app/ci4-app/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/ci4-app-error.log
    CustomLog ${APACHE_LOG_DIR}/ci4-app-access.log combined
</VirtualHost>
```

### 3. mod_rewriteの有効化

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### 4. .envファイルの作成

`ci4-app`ディレクトリに`.env`ファイルを作成します。

```bash
cd /var/www/html/ci4-app/ci4-app
cp env .env
```

`.env`ファイルを編集：

```ini
# 本番環境設定
CI_ENVIRONMENT = production

# アプリケーション設定
app.baseURL = 'https://example.com/'
app.indexPage = ''

# データベース設定
database.default.hostname = localhost
database.default.database = your_database_name
database.default.username = your_database_user
database.default.password = your_database_password
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306

# セキュリティ設定
IP_RESTRICTION_ENABLED = true
ADMIN_SESSION_TIMEOUT = 3600

# メール設定
MAIL_FROM_ADDRESS = 'noreply@example.com'
MAIL_FROM_NAME = 'Your Application Name'
```

### 5. パーミッションの設定

```bash
# writableディレクトリに書き込み権限を付与
sudo chown -R www-data:www-data /var/www/html/ci4-app/ci4-app/writable
sudo chmod -R 755 /var/www/html/ci4-app/ci4-app/writable

# .envファイルのセキュリティ
sudo chmod 600 /var/www/html/ci4-app/ci4-app/.env
```

### 6. Composer依存関係のインストール

```bash
cd /var/www/html/ci4-app/ci4-app
composer install --no-dev --optimize-autoloader
```

### 7. データベースマイグレーション

```bash
php spark migrate
```

### 8. キャッシュのクリア

```bash
# キャッシュディレクトリをクリア
rm -rf writable/cache/*
```

## セキュリティチェックリスト

- [ ] CI_ENVIRONMENTをproductionに設定
- [ ] .envファイルのパーミッションを600に設定
- [ ] writableディレクトリのパーミッションを適切に設定
- [ ] app/.htaccessでappディレクトリへの直接アクセスを拒否
- [ ] IP制限を有効化（IP_RESTRICTION_ENABLED = true）
- [ ] SSL証明書の設定（HTTPS化）
- [ ] データベースパスワードの強化
- [ ] セッションの暗号化キー設定
- [ ] エラー表示を無効化（display_errors = Off）

## トラブルシューティング

### URLにindex.phpが表示される

1. mod_rewriteが有効か確認
   ```bash
   apache2ctl -M | grep rewrite
   ```

2. AllowOverride Allが設定されているか確認
   ```bash
   cat /etc/apache2/sites-available/your-site.conf
   ```

3. .htaccessファイルが存在するか確認
   ```bash
   ls -la /var/www/html/ci4-app/ci4-app/public/.htaccess
   ```

### 403 Forbiddenエラー

1. DocumentRootの設定を確認
2. Directoryディレクティブで`Require all granted`が設定されているか確認
3. ファイルパーミッションを確認

### 500 Internal Server Errorエラー

1. Apacheエラーログを確認
   ```bash
   sudo tail -f /var/log/apache2/error.log
   ```

2. writable/logsディレクトリの書き込み権限を確認
3. .envファイルの設定を確認

## 本番環境の推奨設定

### php.ini設定

```ini
display_errors = Off
log_errors = On
error_log = /var/log/php/error.log
upload_max_filesize = 100M
post_max_size = 100M
memory_limit = 512M
max_execution_time = 600
max_input_time = 600
```

### Apache設定の最適化

```apache
# Compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css
    AddOutputFilterByType DEFLATE application/javascript application/json
</IfModule>

# Browser Caching
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

## バックアップ

定期的に以下をバックアップしてください：

1. データベース
   ```bash
   mysqldump -u username -p database_name > backup_$(date +%Y%m%d).sql
   ```

2. アップロードファイル
   ```bash
   tar -czf uploads_$(date +%Y%m%d).tar.gz writable/uploads/
   ```

3. .envファイル
   ```bash
   cp .env .env.backup_$(date +%Y%m%d)
   ```
