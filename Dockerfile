FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install mysqli zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configure Apache
RUN a2enmod rewrite

# Create a non-root user to run the application
RUN groupadd -g 1000 appuser && \
    useradd -u 1000 -g appuser -s /bin/bash -m appuser

# Set up the application
WORKDIR /var/www/html

# Copy application files with correct ownership
COPY --chown=appuser:appuser . /var/www/html

# Set proper permissions
RUN chown -R appuser:appuser /var/www/html && \
    chmod -R 755 /var/www/html && \
    chown -R appuser:appuser /var/log/apache2 && \
    chown -R appuser:appuser /var/run/apache2

# Update Apache configuration to run as the non-root user
RUN sed -i 's/export APACHE_RUN_USER=www-data/export APACHE_RUN_USER=appuser/' /etc/apache2/envvars && \
    sed -i 's/export APACHE_RUN_GROUP=www-data/export APACHE_RUN_GROUP=appuser/' /etc/apache2/envvars

# Configure PHP for production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 10M/' "$PHP_INI_DIR/php.ini" && \
    sed -i 's/post_max_size = 8M/post_max_size = 10M/' "$PHP_INI_DIR/php.ini" && \
    sed -i 's/memory_limit = 128M/memory_limit = 256M/' "$PHP_INI_DIR/php.ini"

# Set environment variables
ENV APACHE_DOCUMENT_ROOT=/var/www/html
ENV PHP_OPCACHE_ENABLE=1
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=0

# Security: Disable access to .git directories
RUN echo '<DirectoryMatch "^/.*/\.git/">\n\
    Require all denied\n\
</DirectoryMatch>' > /etc/apache2/conf-available/git-security.conf && \
    a2enconf git-security

EXPOSE 80

# Switch to the non-root user
USER appuser

CMD ["apache2-foreground"]
