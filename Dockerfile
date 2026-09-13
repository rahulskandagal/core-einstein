FROM php:8.2-apache

# mysqli extension for the app's database layer
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY . /var/www/html/
COPY docker/protect.conf /etc/apache2/conf-enabled/protect.conf
RUN chmod +x /var/www/html/docker/entrypoint.sh

EXPOSE 80
ENTRYPOINT ["sh", "/var/www/html/docker/entrypoint.sh"]
