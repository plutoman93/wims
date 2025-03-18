FROM php:8.3-apache

# ติดตั้งส่วนเสริมของ PHP ที่ Laravel ต้องใช้
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring gd

# ติดตั้ง Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# กำหนดไดเรกทอรีทำงาน
WORKDIR /var/www/html
COPY . .

# เปิดใช้งาน mod_rewrite ของ Apache
RUN a2enmod rewrite

# ตั้งค่า VirtualHost สำหรับ Apache
RUN echo '<VirtualHost *:80>' > /etc/apache2/sites-available/000-default.conf \
    && echo '    DocumentRoot /var/www/html/public' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    <Directory /var/www/html/public>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        AllowOverride All' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        Require all granted' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    </Directory>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '</VirtualHost>' >> /etc/apache2/sites-available/000-default.conf

# ให้สิทธิ์ storage และ bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# กำหนดพอร์ตของ Apache
EXPOSE 80

# คำสั่งเริ่มต้น
CMD ["apache2-foreground"]
