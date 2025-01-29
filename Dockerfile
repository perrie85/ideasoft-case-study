FROM php:8.4-alpine

# Install dependencies
RUN apk add --no-cache --virtual .build-deps \
    autoconf \
    dpkg-dev \
    dpkg \
    file \
    g++ \
    gcc \
    libc-dev \
    make \
    pkgconf \
    re2c \
    curl-dev \
    libpng-dev \
    libzip-dev \
    nodejs \
    npm \
    && apk add --no-cache \
    curl \
    git \
    libzip \
    libffi-dev \
    librdkafka-dev \
    postgresql-dev \
    postgresql-libs \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pcntl


# Install PHP extensions
RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install sockets


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .
COPY .env.example .env

# Install dependencies
RUN composer install --no-interaction --prefer-dist

# Set file permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache
