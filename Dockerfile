# Use the official PHP image as the base image
FROM php:7.4-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd pdo pdo_mysql zip

# Set the working directory to /var/www
WORKDIR /var/www

# Copy the Laravel application files to the container
COPY /home/bilaljaved/Work/task-navigator-backend/ ./

# Move composer.json and composer.lock to the root of the Laravel app
RUN mv ./composer.json ./composer.lock ./

# Install Composer and run 'composer install'
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist

# Expose the container port (adjust if your app uses a different port)
EXPOSE 9000

# Start the PHP-FPM server
CMD ["php-fpm"]
