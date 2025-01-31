# Use the official PHP image
FROM php:8.1-apache

# Install required PHP extensions, including MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy application files to the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
