FROM php:8.1.3-apache-buster

COPY --from=composer:2.2.7 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get -y install unzip libzip-dev libpng-dev libxslt-dev && \
    docker-php-ext-install gd xsl zip intl opcache pdo_mysql
