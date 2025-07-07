FROM php:8.3-fpm

# PHP拡張
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www

# アプリケーションを全部コピー
COPY . .

# ccomposer install実行
RUN composer install
