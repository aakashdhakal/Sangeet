FROM php:8.2-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite
RUN a2enmod rewrite

# Install cloudflared
RUN apt-get update && apt-get install -y curl && \
    curl -L https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-amd64 -o /usr/local/bin/cloudflared && \
    chmod +x /usr/local/bin/cloudflared

# Copy your PHP app
COPY . /var/www/html/

# Set working dir
WORKDIR /var/www/html/

# Expose HTTP port
EXPOSE 80

# Launch cloudflared tunnel in background and Apache in foreground
CMD cloudflared access tcp --hostname mysql.aakashdhakal.com.np --url localhost:3306 & apache2-foreground


