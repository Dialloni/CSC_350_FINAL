FROM php:8.2-apache

RUN a2enmod rewrite

WORKDIR /var/www/html

# COPY everything in the app folder — not just public/
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
