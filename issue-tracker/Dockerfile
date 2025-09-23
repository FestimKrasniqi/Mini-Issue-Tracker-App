# Stage 1: Build PHP dependencies
FROM composer:2.6 as build
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader
COPY . .

# Stage 2: Runtime
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev nginx \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Copy PHP dependencies from build stage
WORKDIR /var/www
COPY --from=build /app /var/www

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Configure Nginx
COPY ./nginx.conf /etc/nginx/conf.d/default.conf

# Expose port
EXPOSE 80

# Start both PHP-FPM and Nginx
CMD service nginx start && php-fpm
