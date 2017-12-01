FROM composer:1 AS build-env
COPY . /app
RUN cd /app && composer install --prefer-dist --optimize-autoloader --no-scripts --no-dev --ignore-platform-reqs 

FROM busyunit/php7-apache-laravel-pdf
ENV PORT 80
EXPOSE 80
COPY --from=build-env /app $APP_HOME
RUN chown -R www-data:www-data $APP_HOME
