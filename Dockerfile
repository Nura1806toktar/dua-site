FROM php:8.2-cli

# Composer және қажетті пакеттер
RUN apt-get update && apt-get install -y unzip curl libzip-dev zip \
    && docker-php-ext-install zip

# Composer орнату
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app

# Laravel кэштерін тазалау және composer install
RUN composer install
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8000

# ✅ Міне дұрыс CMD:
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
