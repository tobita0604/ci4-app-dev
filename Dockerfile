FROM php:8.3-apache

# 必要なPHP拡張をインストール
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libxml2-dev \
    libzip-dev \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        intl \
        dom \
        xml \
        zip \
        gd \
        pdo_mysql \
        mysqli

# Apacheモジュールを有効化
RUN a2enmod rewrite headers ssl

# ServerNameを設定してFQDN警告を解消
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# DocumentRootをCodeIgniter 4のpublicディレクトリに設定
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# PHP設定の最適化（テンプレート管理システム用）
RUN echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/template-system.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/template-system.ini \
    && echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/template-system.ini \
    && echo "max_execution_time = 600" >> /usr/local/etc/php/conf.d/template-system.ini \
    && echo "max_input_time = 600" >> /usr/local/etc/php/conf.d/template-system.ini

WORKDIR /var/www/html
COPY ./ci4-app .
RUN chown -R www-data:www-data /var/www/html

# Composerをインストール
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Composer依存関係をインストール
RUN composer install --no-dev --optimize-autoloader
