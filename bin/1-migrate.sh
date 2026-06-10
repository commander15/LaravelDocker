#!/usr/bin/env sh

# Running migrations
php artisan migrate --force --no-interaction --isolated=true
