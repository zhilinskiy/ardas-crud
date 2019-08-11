FROM php:7.3-fpm

ENV TIMEZONE UTC
ENV GROUPUID 1000
ENV USERUID 1000

RUN apt-get update && apt-get install -y \
    build-essential \
    openssl \
    zlib1g-dev libicu-dev g++ \
    locales \
    libpng-dev libzip-dev libpq-dev libsqlite3-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libxml2-dev \
    jpegoptim optipng pngquant gifsicle \
    zip \
    unzip \
    git \
    curl \
    wget \
    && ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version \
    && curl -sL https://deb.nodesource.com/setup_12.x | bash -- \
    && apt-get install -y nodejs && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo \
        pdo_mysql \
        pdo_pgsql \
        pdo_sqlite \
        mbstring \
        opcache \
        zip \
        exif \
        pcntl \
        bcmath \
        json \
        ctype \
        tokenizer \
        xml \
        gd \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN groupadd -g ${GROUPUID} www \
    && useradd -u ${USERUID} -ms /bin/bash -g www www

WORKDIR /var/www
USER www
CMD ["php-fpm"]