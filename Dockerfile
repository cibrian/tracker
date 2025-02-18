# Use the official PHP image with PHP 8
FROM php:8.0-apache

# Install additional PHP extensions if needed
RUN docker-php-ext-install pdo pdo_mysql

# Copy the current directory contents into the container at /var/www/html
## No needed as I want to edit from IDE!!! COPY . /var/www/html/

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# This prevents that container create root 
# Create a user with the same UID and GID as the host user
ARG UID=1000
ARG GID=1000
RUN groupadd -g ${GID} appgroup && useradd -u ${UID} -g appgroup -m appuser

# Set the working directory
WORKDIR /var/www/html

# Change ownership of the working directory to the new user
RUN chown -R appuser:appgroup /var/www/html

# Switch to the new user
USER appuser

# Expose port 80
EXPOSE 80

# Start Apache server in the foreground
CMD ["apache2-foreground"]


