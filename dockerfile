# Gunakan image resmi PHP dengan Apache
FROM php:7.4-apache

# Install ekstensi PHP yang diperlukan
RUN docker-php-ext-install mysqli

# Salin kode proyek ke dalam container
COPY . /var/www/html/

# Berikan izin yang sesuai
RUN chown -R www-data:www-data /var/www/html/

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Konfigurasi Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf