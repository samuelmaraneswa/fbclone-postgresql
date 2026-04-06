# =========================
# STEP 1: Composer install
# =========================
FROM composer:2 AS builder

WORKDIR /app

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader


# =========================
# STEP 2: PHP runtime
# =========================
FROM php:8.2-cli

WORKDIR /app

# Install extension yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring bcmath

# Copy hasil dari builder
COPY --from=builder /app /app

# Port Render
EXPOSE 10000

# Run Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000