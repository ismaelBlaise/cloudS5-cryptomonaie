# Utiliser une image PHP avec extensions nécessaires
FROM php:8.2-fpm

# Installer des dépendances système
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer Node.js et npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le code source
COPY . .

# Installer les dépendances de Laravel
RUN composer install --optimize-autoloader --no-dev
RUN npm install && npm run build

# Changer les permissions pour Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
