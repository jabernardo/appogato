FROM php:7.0-apache

# Copy files to /var/www/appogato
ADD . /var/www/appogato

# Create a symlink for public
# then allow file permission for cache, db and log
RUN rm -rf /var/www/html && ln -s /var/www/appogato/public /var/www/html &&\
    chown -R www-data /var/www/appogato/app/storage/cache /var/www/appogato/app/storage/log /var/www/appogato/app/storage/db

# Install vim and common php libs
RUN apt update && apt install vim libz-dev libmcrypt-dev libmemcached-dev -y

# Intall memcached from pecl other php ext through `docker-php-ext-install`
RUN pecl install memcached &&\
    docker-php-ext-enable memcached &&\
    docker-php-ext-install mysqli mcrypt

# Enable php for apache
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80
