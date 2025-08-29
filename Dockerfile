# Base image PHP
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependensi sistem
RUN apt-get update && apt-get install -y \
    build-essential \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

# Install ekstensi PHP
RUN docker-php-ext-install pdo pdo_pgsql pgsql bcmath zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js & NPM
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

# 1. Salin file dependensi terlebih dahulu
COPY composer.json composer.lock ./
COPY package.json package-lock.json ./

# 2. Install dependensi (langkah ini akan di-cache jika file di atas tidak berubah)
RUN composer install --no-scripts --no-autoloader
RUN npm install

# 3. Salin sisa file aplikasi
COPY . .

# 4. Selesaikan instalasi Composer dan build aset
RUN composer install --optimize-autoloader --no-dev
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port untuk PHP-FPM
EXPOSE 9000
