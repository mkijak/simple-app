FROM php:8.0-fpm

RUN apt-get update && apt-get install -y libssl-dev libzip-dev zlib1g-dev librabbitmq-dev libpq-dev libicu-dev libpng-dev libxml2-dev libpq-dev \
  && rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql bcmath intl gd \
  && pecl channel-update pecl.php.net && pecl install xdebug mongodb zip amqp-1.11.0beta \
  && docker-php-ext-enable xdebug zip mongodb amqp

RUN useradd -ms /bin/bash user
USER user

WORKDIR /app
COPY php-fpm.conf /etc/php-fpm.conf

