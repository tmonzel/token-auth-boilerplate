FROM php:7.2-apache

# Serve documents from /public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public 

# Fetch and install composer from image
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Enable apache rewrite module
RUN a2enmod rewrite

# Install PDO MySQL extension
RUN docker-php-ext-install pdo_mysql

# Point available sites configuration to the new document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf