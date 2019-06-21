#!/bin/bash

php php artisan migrate --seed
php artisan passport:install --force
exec /usr/local/sbin/php-fpm --nodaemonize