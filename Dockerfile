FROM php:8.5-fpm-alpine

WORKDIR /var/www/html

# Copy the official Composer binary from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy helper scripts on system
# Copy scripts directly to the destination and set permissions in a single step
COPY --chmod=755 scripts/ /usr/bin/

# Install the PHP extension installer script safely
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/bin/

# Install essential Laravel extensions (gd, bcmath, etc.)
RUN apk add --no-cache supervisor && \
    chmod +x /usr/bin/install-php-extensions && \
    install-php-extensions gd bcmath opcache zip

# Copy Nginx and Supervisor config files
COPY nginx.conf /etc/nginx/http.d/default.conf
COPY supervisor/supervisord.conf /etc/supervisor/supervisord.conf
COPY supervisor/web.conf /etc/supervisor/conf.d/web.conf.example
COPY supervisor/worker.conf /etc/supervisor/conf.d/worker.conf.example

# Copy default index.php
COPY public/ ./public

# Create a non-root system user for security matching your ownership intent
RUN addgroup -g 1000 laravel && \
    adduser -u 1000 -G laravel -s /bin/sh -D laravel

# Switch to the non-root user
# USER laravel

# Expose Nginx port instead of PHP-FPM
EXPOSE 8000

# Start Supervisor to manage both Nginx and PHP-FPM
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
