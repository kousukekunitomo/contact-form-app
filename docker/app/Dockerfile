FROM php:8.2-fpm

# 必要なパッケージと拡張モジュールのインストール
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql

# Composer インストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリの指定
WORKDIR /var/www

# Laravel アプリをコピー
COPY . /var/www

# Composer で依存パッケージをインストール
RUN composer install --no-interaction --prefer-dist --optimize-autoloader
