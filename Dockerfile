FROM php:8.2-cli

# Composer орнату
RUN apt-get update && apt-get install -y unzip curl libzip-dev zip \
    && docker-php-ext-install zip

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Жоба файлын көшіру
WORKDIR /app
COPY . /app

# Composer install
RUN composer install

# Laravel key generate үшін PHP artisan
RUN php artisan config:clear || true

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
