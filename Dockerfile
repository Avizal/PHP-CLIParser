FROM php:7.4-fpm

LABEL maintainer="Ruslan Prichepa <avizal@protonmail.com>"

# Install packets
RUN apt-get update && apt-get install -y \
        nano \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
		libzip-dev \
    && docker-php-ext-install -j$(nproc) iconv zip \
    && docker-php-ext-configure gd \
        --with-freetype=/usr/include/  \
        --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER www-data:www-data

# Set directory PHP
WORKDIR /var/www
COPY . .

# Start
CMD ["php-fpm"]