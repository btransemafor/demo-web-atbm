FROM php:8.1-apache

# Copy toàn bộ mã nguồn vào thư mục web của Apache
COPY . /var/www/html/

# Cài đặt extension PHP kết nối MySQL
RUN docker-php-ext-install mysqli

# Cấp quyền thư mục cho Apache
RUN chown -R www-data:www-data /var/www/html
