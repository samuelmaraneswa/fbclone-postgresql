FROM composer:2 AS builder

WORKDIR /app
COPY . .
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

FROM php:8.4-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libonig-dev libxml2-dev libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip mbstring bcmath

# ⬇️ COPY dulu
COPY --from=builder /app /app

# ⬇️ baru build Vite
RUN npm install && npm run build

RUN php artisan config:clear
RUN php artisan view:clear
RUN php artisan cache:clear

EXPOSE 10000

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000