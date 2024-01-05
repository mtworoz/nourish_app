FROM php:8.3-apache

RUN mkdir -p /tmp/runtime-www-data && chown www-data:www-data /tmp/runtime-www-data

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && apt-get install -y wkhtmltopdf fonts-dejavu fonts-freefont-ttf ttf-bitstream-vera

ENV XDG_RUNTIME_DIR=/tmp/runtime-www-data

RUN mkdir -p /var/cache/fontconfig && \
    chown www-data:www-data /var/cache/fontconfig

RUN chmod 0700 /tmp/runtime-www-data \
    && chown www-data:www-data /tmp/runtime-www-data

RUN a2enmod rewrite
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/project

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
#COPY app/composer.json composer.json
#COPY app/composer.lock composer.lock
#RUN composer install --no-dev