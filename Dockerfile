FROM node:14-alpine AS npmBuild
WORKDIR /app
COPY . .
RUN npm install
RUN npm run prod
RUN rm -Rf node_modules

FROM php:7.4-fpm-alpine AS finalBuild
RUN docker-php-ext-install pdo pdo_mysql sockets
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY --from=npmBuild /app .
RUN composer install --optimize-autoloader --no-dev
RUN php artisan route:cache
RUN php artisan view:cache
