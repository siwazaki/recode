#!/bin/sh
mysql -u root -ppassw0rd -e"drop database recode"
mysql -u root -ppassw0rd -e"create database recode"
composer dump-autoload
php artisan migrate --seed
php artisan db:seed --env=local

