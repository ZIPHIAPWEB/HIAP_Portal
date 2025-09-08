FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libsodium-dev default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql sodium zip \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Explicitly enable the extensions (writes .ini files to /usr/local/etc/php/conf.d/)
RUN docker-php-ext-enable gd pdo_mysql sodium zip

# Install Node.js 16.x (stable with Webpack 4/5)
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Create a non-root user (vscode) for devcontainer
RUN useradd -ms /bin/bash vscode \
    && usermod -aG sudo vscode

USER vscode
