FROM php:8.3-apache

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && apt-get install -y wkhtmltopdf

RUN a2enmod rewrite
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/project

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
#COPY app/composer.json composer.json
#COPY app/composer.lock composer.lock
#RUN composer install --no-dev