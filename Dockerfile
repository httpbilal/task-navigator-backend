# Base image
FROM composer:2 as builder

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./


# Install project dependencies
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Copy the rest of the project files
COPY . .

# Build production assets
RUN php artisan optimize --force

# Final image
FROM php:7.4-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk --no-cache add \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    zlib-dev \
    libzip-dev \
    postgresql-dev \
    oniguruma-dev \
    freetype-dev

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Copy project files from the builder stage
COPY --from=builder /var/www/html .

# Set environment variables
ENV APP_ENV=production
ENV APP_KEY=base64:rBOaTS9mDgNXOVFzUP5uhLXr0PrLdrRMjq7IfJS2EZA=
ENV APP_DEBUG=false
ENV DB_CONNECTION=pgsql
ENV DB_HOST=postgres
ENV DB_PORT=5432
ENV DB_DATABASE=task-navigator-backend-db
ENV DB_USERNAME=postgres
ENV DB_PASSWORD=1166
ENV JWT_SECRET=o66iC7Uk6R3BMUdxWly39pLTxt6ZoU1CPZfxwmoHs4YM51zMlxPlW62EruCqG3FC

# Expose port
EXPOSE 8000

# Start the PHP development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
