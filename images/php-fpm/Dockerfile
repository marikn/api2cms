FROM php:5.6-fpm

COPY ./php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y \
        git \
        libpq-dev \
        libpcre3-dev \
        php5-dev \
        php5-pgsql \
    && docker-php-ext-install -j$(nproc) pgsql \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/include/postgresql/ -with-pdo-pgsql=/usr/include/postgresql/ \
    && docker-php-ext-install -j$(nproc) pdo_pgsql

RUN yes | pecl install zip \
    && docker-php-ext-install -j$(nproc) zip

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN git clone git://github.com/phalcon/cphalcon.git \
    && ( \
        cd cphalcon/build \
        && ./install \
    ) \
    && rm -r cphalcon \
    && docker-php-ext-enable phalcon

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer