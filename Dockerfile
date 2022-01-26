FROM php:8.0-fpm-alpine
# Setup working directory
WORKDIR /var/www
RUN apk add --update --no-cache openssl bash mysql-client nodejs npm alpine-sdk autoconf vim gd libzip-dev zip mysql-client unzip
RUN apk add --update --no-cache libpng libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev libxpm-dev libsodium-dev
RUN apk add --update --no-cache sqlite
RUN apk add --update --no-cache sqlite-dev
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev \
    imagemagick-dev
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql bcmath  zip pdo_sqlite exif fileinfo


RUN docker-php-ext-install iconv
RUN docker-php-ext-install gd
RUN yes | pecl install \
    igbinary \
    xdebug \
    imagick \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo " xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN docker-php-ext-enable \
    imagick
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Create system user to run Composer and Artisan Commands
EXPOSE 9000
COPY core/entrypoint.sh /tmp/entrypoint.sh
RUN composer global require "squizlabs/php_codesniffer=*"
RUN chown -R www-data:www-data /var/www
RUN chmod 777 -R /tmp && chmod o+t -R /tmp
ENTRYPOINT ["/tmp/entrypoint.sh"]