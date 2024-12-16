# Use the official PHP Apache image as a base
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Copy your project files into the container
COPY . /var/www/html

# Install necessary extensions (optional, add as needed)
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Set the Apache DocumentRoot to your project's public directory
WORKDIR /var/www/html/comp307-finalproject/public/landing

# Expose port 80 for the application
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
