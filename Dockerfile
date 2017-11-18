FROM composer:1 AS build-env
COPY . /app
RUN cd /app && composer install --prefer-dist --optimize-autoloader --no-scripts --no-dev --profile --ignore-platform-reqs 

FROM php:7.1-apache
ENV PORT 80
EXPOSE 80
COPY --from=build-env /app /var/www/html
COPY ./apache/site.conf /etc/apache2/sites-available/
RUN usermod -u 1000 www-data; \
    a2dissite 000-default.conf; \
    a2ensite site.conf;\
    a2enmod rewrite; \
    chown -R www-data:www-data /var/www/html; \
    service restart apache2
