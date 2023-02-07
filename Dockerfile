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
COPY --from=npmBuild /app .
RUN composer install --optimize-autoloader
RUN php artisan route:cache
RUN php artisan view:cache
