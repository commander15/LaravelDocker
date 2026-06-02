#!/bin/sh

# Exit immediately if a command exits with a non-zero status
set -e

# Moving to project dir
cd /var/www/html

# Initialize boolean flags (0 = false, 1 = true)
RUN_WEB=0
RUN_API=0
RUN_WORKER=0

# Loop through all arguments to detect present options
for arg in "$@"; do
    if [ "$arg" = "--web" ]; then RUN_WEB=1; fi
    if [ "$arg" = "--api" ]; then RUN_API=1; fi
    if [ "$arg" = "--worker" ]; then RUN_WORKER=1; fi
done

# FIXED: Updated validation logic to check for $RUN_WORKER instead of $RUN_SEED
if [ "$RUN_WEB" -eq 0 ] && [ "$RUN_API" -eq 0 ] && [ "$RUN_WORKER" -eq 0 ]; then
    echo "➔ Error: No valid flags provided."
    echo "➔ Usage: $0 [--web] [--api] [--worker] (You can combine them)"
    exit 1
fi

# ----------------------------------------
# Shared Base Steps
# ----------------------------------------
echo "➔ Installing dependencies..."
composer install --no-dev --no-scripts --no-autoloader --prefer-dist
composer dump-autoload --optimize

echo "➔ Optimizing configuration and routes..."
php artisan config:cache
php artisan route:cache

# ----------------------------------------
# Conditional Steps based on options
# ----------------------------------------

if [ "$RUN_WEB" -eq 1 ]; then
    echo "➔ Running Web-specific tasks (View Caching)..."
    php artisan view:cache
fi

if [ "$RUN_API" -eq 1 ]; then
    echo "➔ Running API-specific tasks (Migrations)..."
    php artisan migrate --force --no-interaction --step
    
    echo "➔ Running Seeders..."
    php artisan db:seed --force --no-interaction
fi

# ----------------------------------------
# Server Execution Control
# ----------------------------------------
if [ "$RUN_WEB" -eq 1 ] || [ "$RUN_API" -eq 1 ]; then
    echo "➔ Installing Server (Nginx)..."
    apk add --no-cache nginx
    
    echo "➔ Activating Web/API Supervisor config..."
    # Using -f (force) to prevent script from hanging if the destination file already exists
    mv -f /etc/supervisor/conf.d/web.conf.example /etc/supervisor/conf.d/web.conf
fi

if [ "$RUN_WORKER" -eq 1 ]; then
    echo "➔ Activating Worker Supervisor config..."
    mv -f /etc/supervisor/conf.d/worker.conf.example /etc/supervisor/conf.d/worker.conf
fi
