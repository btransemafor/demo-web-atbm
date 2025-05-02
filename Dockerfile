FROM php:8.1-apache

# Cài extension mysqli để PHP dùng MySQL
RUN docker-php-ext-install mysqli

# Copy source vào thư mục web
COPY . /var/www/html/

# Set quyền đúng để Apache truy cập
RUN chown -R www-data:www-data /var/www/html

#  Phải expose cổng 80 để Railway nhận diện service
EXPOSE 80
