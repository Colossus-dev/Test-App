FROM php:8.2-fpm
WORKDIR /var/www/html
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo mbstring pdo_mysql zip
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

