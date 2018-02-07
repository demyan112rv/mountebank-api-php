FROM php:7.1-fpm

RUN apt-get update && apt-get install -y curl

# Pecl
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug


