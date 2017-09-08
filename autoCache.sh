#!/bin/bash

cd "/home/wwwroot/godsky.org/"

php artisan config:cache

php artisan route:cache

php artisan optimize --force

composer dumpautoload -o