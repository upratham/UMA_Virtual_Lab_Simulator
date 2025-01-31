# Use the official PHP image
FROM php:8.1-apache

# Copy application files to the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html

# Install required PHP extensions (if needed)
RUN docker-php-ext-install mysqli

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
