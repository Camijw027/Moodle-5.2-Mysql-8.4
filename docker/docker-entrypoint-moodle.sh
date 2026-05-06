#!/bin/sh
set -e

mkdir -p /var/www/moodledata
chown -R www-data:www-data /var/www/moodledata || true
chmod -R u+rwX,g+rwX /var/www/moodledata || true

exec docker-php-entrypoint apache2-foreground
