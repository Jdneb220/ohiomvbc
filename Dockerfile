FROM php:5.6-apache

# Install the legacy mysql extension
RUN docker-php-ext-install mysql

# Copy your app into the container
COPY . /var/www/html/

# Enable Apache mod_rewrite (optional)
RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]
