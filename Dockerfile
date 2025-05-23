FROM php:8.2-apache

# Enable .htaccess support
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all files inside php-judging-app/public/ to Apache root
COPY public/ /var/www/html/

# Optional: Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
