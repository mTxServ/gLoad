FROM php:7.3-fpm

ENV DEBIAN_FRONTEND="noninteractive" \
    COMPOSER_ALLOW_SUPERUSER=1

# Set timezone
RUN rm /etc/localtime && ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    gnupg \
    libcurl4-gnutls-dev \
    libicu-dev

RUN rm -rf /var/lib/apt/list*

RUN docker-php-ext-install pdo pdo_mysql mysqli bcmath intl mbstring curl opcache zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# user
RUN useradd -ms /bin/bash app
USER app

WORKDIR /app

COPY conf/php-fpm.conf /etc/php-fpm.conf
COPY conf/php.ini /usr/local/etc/php/conf.d/100-php.ini
