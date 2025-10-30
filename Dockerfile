FROM php:5.6-apache

# Copy your app into the container
COPY . /var/www/html/

# Enable Apache mod_rewrite (optional)
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
