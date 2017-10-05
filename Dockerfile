FROM php:7.0-apache
ADD . /var/www/lmvc
RUN rm -rf /var/www/html && ln -s /var/www/lmvc/htdocs /var/www/html &&\
    chmod -R 777 /var/www/lmvc/app/cache /var/www/lmvc/app/log &&\
    apt update && apt install vim libmcrypt-dev -y &&\
    docker-php-ext-install mysqli mcrypt
RUN a2enmod rewrite
EXPOSE 80
