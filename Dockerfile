FROM serversideup/php:8.3-fpm-nginx

COPY --chown=www-data:www-data . /var/www/html

WORKDIR /var/www/html

USER root

# Install Node.js and npm for asset building
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Install composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Install npm dependencies and build assets
RUN npm install && npm run build

# Setup Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data

EXPOSE 8080
