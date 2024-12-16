# Base image
FROM php:8.2-apache

# Set the working directory
WORKDIR /var/www/html

# Copy project files to the container
COPY ./comp307-finalproject /var/www/html/

# Enable Apache mod_rewrite (if needed)
RUN a2enmod rewrite

# Set permissions for Apache
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
