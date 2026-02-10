FROM php:8.2-apache

# 1️⃣ Librerías del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    sqlite3 \
    libsqlite3-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# 2️⃣ Extensiones PHP para Laravel + SQLite
RUN docker-php-ext-install \
    pdo \
    pdo_sqlite \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd

# 3️⃣ Apache necesita rewrite
RUN a2enmod rewrite

# 4️⃣ Apache debe servir /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# 5️⃣ Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6️⃣ Código
WORKDIR /var/www/html
COPY . .

# 7️⃣ SQLite
RUN touch database/database.sqlite

# 8️⃣ Dependencias
RUN composer install

# 9️⃣ Permisos
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache \
    database/database.sqlite

EXPOSE 80
