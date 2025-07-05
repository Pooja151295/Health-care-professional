# Use an official PHP image
FROM php:8.4-fpm

# Install system packages: MySQL client + build tools for PHP extensions
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    netcat-openbsd \
    wget \
    git \
    unzip \
    autoconf \
    build-essential \
    pkg-config \
    libssl-dev \
    libcurl4-openssl-dev \
    libpng-dev \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions using the official helper script
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node & npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Add your custom php.ini
COPY ./docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Create config directory with full permissions (if really needed)
RUN mkdir /.config/ && chmod -R 777 /.config

# Change PHP-FPM user from www-data to root (not recommended for prod!)
RUN sed -i -e 's/ = www-data/ = root/g' /usr/local/etc/php-fpm.d/www.conf


COPY ./docker/php/wait-for.sh /usr/bin/wait-for.sh

RUN chmod +x /usr/bin/wait-for.sh

WORKDIR /var/www/app

# Copy project code
COPY . /var/www/app

# Set the default entrypoint
ENTRYPOINT ["/bin/sh", "./docker/php/entrypoint.sh"]