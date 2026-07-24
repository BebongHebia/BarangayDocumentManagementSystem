FROM serversideup/php:8.4-fpm-nginx

COPY --chown=www-data:www-data . /var/www/html

WORKDIR /var/www/html

USER root

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Install dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Build assets
RUN npm install && npm run build

# ⚠️ ADD THIS: Run migrations before caching
RUN php artisan migrate --force

# Cache config, routes, and views
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data

EXPOSE 8080
