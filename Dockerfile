FROM php:8.2-apache

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install dependencies for gRPC
RUN apt-get update && apt-get install -y \
        libz-dev \
        libssl-dev \
        libc-ares-dev

# Install gRPC
RUN pecl install grpc && docker-php-ext-enable grpc

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy source code into container
COPY . /var/www/html

# COPY common/config/firebase.json /var/www/html/common/config/firebase.json

# ENV FIREBASE_KEY_FILE_PATH=/var/www/html/common/config/firebase.json

WORKDIR /var/www/html/gazetki/web

# Set permissions for both virtual hosts
RUN chown -R www-data:www-data /var/www/html/gazetki/web 
# /var/www/html/iulotka/web
RUN chmod -R 755 /var/www/html/gazetki/web 
# /var/www/html/iulotka/web

# Copy Apache configuration file and enable site
COPY apache2/000-default.conf /etc/apache2/sites-available/
COPY apache2/ports.conf /etc/apache2/ports.conf
# COPY apache2/httpd-vhosts.conf /etc/apache2/httpd-vhosts.conf
# RUN echo 'Include /etc/apache2/httpd-vhosts.conf' >> /etc/apache2/apache2.conf

EXPOSE 8080

# Enable site and start Apache
CMD a2ensite 000-default && apache2ctl -D FOREGROUND