FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction --no-progress

FROM php:8.3-apache
WORKDIR /var/www/html

RUN docker-php-ext-install pdo_mysql opcache \
    && a2enmod rewrite

COPY docker/apache/default.conf /etc/apache2/sites-available/000-default.conf

COPY --from=vendor /app/vendor ./vendor
COPY . .
COPY docker/apache/default.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]