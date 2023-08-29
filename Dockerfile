FROM php:8.2.10RC1-zts-bullseye

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql

WORKDIR /var/www

COPY . /var/www

CMD php artisan serve --host=0.0.0.0 --port=8000
