FROM node:14-alpine AS npmBuild
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run prod
RUN rm -Rf node_modules

FROM wyveo/nginx-php-fpm:php74 AS finalBuild
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY nginx.conf /etc/nginx/nginx.conf
WORKDIR /usr/share/nginx/html
COPY composer.json composer.lock ./
RUN composer install --no-autoloader 
COPY --from=npmBuild /app .
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini
RUN composer dump-autoload --optimize
RUN php artisan route:cache
RUN php artisan view:cache
