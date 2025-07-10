# Dockerfile
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo_mysql mbstring exif bcmath gd zip opcache \
    && git config --global --add safe.directory /var/www

# Install Node.js (example for Node 18.x)
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Optional: verify installation
RUN node -v
RUN npm -v

# Set working directory
WORKDIR /var/www

# Copy existing application
COPY . .

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 8080


CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]