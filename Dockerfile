FROM wordpress:php8.2-apache

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html