FROM php:8.2-apache

# mysqli extension for the app's database layer
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY . /var/www/html/

EXPOSE 80
