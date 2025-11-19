FROM php:8-apache
RUN mkdir /var/www/html/list
COPY php/latest.php /var/www/html/latest.php
