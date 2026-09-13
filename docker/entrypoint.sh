#!/bin/sh
set -e

# Railway/Heroku-style hosts inject PORT; make Apache listen on it.
if [ -n "$PORT" ] && [ "$PORT" != "80" ]; then
  sed -i "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
  sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf
fi

# Some builders lose the base image's a2dismod of mpm_event, leaving two MPMs
# enabled ("More than one MPM loaded"). Guarantee exactly one: prefork.
rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.*
[ -e /etc/apache2/mods-enabled/mpm_prefork.load ] || a2enmod -q mpm_prefork

# Create schema + sample data if the database is empty.
php /var/www/html/docker/seed.php || true

exec apache2-foreground
