FROM php:8.2.10RC1-zts-bullseye

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    curl \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - && \
    apt-get install -y nodejs

# Install Composer php
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

COPY . /var/www

# Generate application key if it doesn't exist
RUN if [ ! -f /var/www/.env ]; then cp /var/www/.env.example /var/www/.env; fi && \
    if [ ! -f /var/www/storage/oauth-private.key ]; then php artisan key:generate; fi

# Install npm dependencies
RUN npm install

# Install Composer dependencies
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000
