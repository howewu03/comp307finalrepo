# Use an official PHP image with Apache
FROM php:8.2-apache

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Copy your application to the container's web root
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html

# Open port 80 to serve the site
EXPOSE 80
