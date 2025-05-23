FROM php:8.2-apache

RUN a2enmod rewrite

WORKDIR /var/www/html

# Copy everything so PHP can include from src/, config/, etc.
COPY . /var/www/html/

# Web entry point is still /var/www/html/public/index.php
# So we'll use Apache config to serve that folder

# Use .htaccess and enable public as web root
RUN rm -rf /var/www/html/html && \
    sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
