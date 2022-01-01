
FROM php:7.4.20-fpm-alpine3.13
# timezone
ARG TZ
WORKDIR /var/www/laravel
COPY ./docker/php/php.ini /usr/local/etc/php/
COPY ./laravel/ /var/www/laravel/

RUN apk upgrade --update && apk add --no-cache \
  coreutils freetype-dev jpeg-dev libjpeg-turbo-dev libpng-dev libmcrypt-dev oniguruma-dev\
  git vim unzip zip libzip-dev tzdata \
  chromium chromium-chromedriver ttf-freefont \
  libltdl autoconf gcc build-base && \
  docker-php-ext-configure zip && \
  docker-php-ext-install zip && \
  pecl install xdebug && \
  docker-php-ext-enable xdebug && \
  docker-php-ext-install pdo_mysql mysqli mbstring && \
  docker-php-ext-install -j$(nproc) iconv && \
  docker-php-ext-configure gd \
  --with-freetype=/usr/include/ \
  --with-jpeg=/usr/include/ && \
  docker-php-ext-install -j$(nproc) gd && \
  cp /usr/share/zoneinfo/${TZ} /etc/localtime && \
  apk del tzdata && \
  rm -rf /var/cache/apk/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
