FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
     && docker-php-ext-configure gd --with-freetype --with-jpeg \
     && docker-php-ext-install pdo_mysql gd

RUN a2enmod rewrite

COPY . /var/www/html
WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache