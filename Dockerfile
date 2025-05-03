FROM php:8.1-apache

# extension mysqli 
RUN docker-php-ext-install mysqli

COPY . /var/www/html/

# Set quyền để Apache truy cập
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80







