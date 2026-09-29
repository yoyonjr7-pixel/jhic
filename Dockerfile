FROM php:8.2-fpm

# Install dependency sistem
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# PHP-FPM configuration
RUN sed -i 's/^;clear_env = no/clear_env = no/' /usr/local/etc/php-fpm.d/www.conf

# PHP performance settings
RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.enable_cli=1'; \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=16'; \
    echo 'opcache.max_accelerated_files=20000'; \
    echo 'opcache.validate_timestamps=1'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'realpath_cache_size=4096K'; \
    echo 'realpath_cache_ttl=600'; \
} > /usr/local/etc/php/conf.d/docker-performance.ini

WORKDIR /var/www

# Copy project
COPY . .

# Install Composer dependencies
RUN composer install \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# Permission Laravel
RUN mkdir -p \
    /var/www/storage \
    /var/www/bootstrap/cache \
    && chown -R www-data:www-data \
    /var/www/storage \
    /var/www/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm", "-F"]