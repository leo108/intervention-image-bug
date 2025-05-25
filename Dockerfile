FROM php:8.4

WORKDIR /app

RUN apt update && apt install -y unzip libmagickwand-dev
RUN pecl install imagick && docker-php-ext-enable imagick
RUN docker-php-ext-install gd
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

COPY . .
RUN composer install
