FROM php:8.2-apache

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy source code into container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html/web

# Set permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Copy Apache configuration file and enable site
COPY apache2/000-default.conf /etc/apache2/sites-available/
COPY apache2/ports.conf /etc/apache2/ports.conf

EXPOSE 8080

# Enable site and start Apache
CMD a2ensite 000-default && apache2ctl -D FOREGROUND