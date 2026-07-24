FROM serversideup/php:8.4-fpm-nginx

COPY --chown=www-data:www-data . /var/www/html

WORKDIR /var/www/html

USER root

# Install Node.js and PostgreSQL driver
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get update && \
    apt-get install -y nodejs php-pgsql

# Install composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Install npm dependencies and build assets
RUN npm install && npm run build

# Create storage directories and set permissions
RUN mkdir -p /var/www/html/storage/logs \
    /var/www/html/storage/framework/cache \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views && \
    chmod -R 775 /var/www/html/storage && \
    chmod -R 775 /var/www/html/bootstrap/cache

# Run migrations
RUN php artisan migrate --force

# Clear and rebuild cache (THIS FIXES THE HEADER ERROR)
RUN php artisan config:clear && \
    php artisan cache:clear && \
    php artisan view:clear && \
    php artisan route:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

USER www-data

EXPOSE 8080
