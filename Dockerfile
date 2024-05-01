# Install Drupal atop the composer base image
FROM composer:2.7.1 AS composer

RUN mkdir -p /var/www/html
