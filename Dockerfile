FROM node:14-alpine AS npmBuild
WORKDIR /app
COPY . .
RUN npm install
RUN npm run prod
RUN rm -Rf node_modules

FROM php:7.4-fpm-alpine AS finalBuild
RUN docker-php-ext-install pdo pdo_mysql sockets
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /usr/share/nginx/html
COPY --from=npmBuild /app .
RUN chown -R www-data:www-data ./
RUN composer install --optimize-autoloader
RUN php artisan route:cache
RUN php artisan view:cache
