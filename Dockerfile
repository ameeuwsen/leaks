FROM php:8.2-apache

RUN apt-get update -y && apt-get install -y libmcrypt-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

RUN composer install

EXPOSE 8666
CMD php bin/console server:run 0.0.0.0:8666

COPY vhosts.conf /etc/apache2/sites-enabled
COPY . /var/www/html/