#!/bin/sh
set -e

# Railway/Heroku-style hosts inject PORT; make Apache listen on it.
if [ -n "$PORT" ] && [ "$PORT" != "80" ]; then
  sed -i "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
  sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf
fi

# Create schema + sample data if the database is empty.
php /var/www/html/docker/seed.php || true

exec apache2-foreground
