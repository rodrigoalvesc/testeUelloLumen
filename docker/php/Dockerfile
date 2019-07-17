FROM php:7.3-apache

VOLUME ["/var/www/html"]

RUN apt-get update && apt-get upgrade

RUN apt-get install -y zlib1g-dev libzip-dev libxml2 libxml2-dev libmcrypt-dev gcc make autoconf libc-dev pkg-config

RUN docker-php-ext-install mysqli pdo pdo_mysql xml zip mbstring

RUN a2enmod rewrite

RUN echo "Listen 9000" >> /etc/apache2/apache2.conf

COPY ./site.conf /etc/apache2/sites-enabled/site.conf