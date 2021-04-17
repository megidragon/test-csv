ARG     PHP_VERSION="${PHP_VERSION:-8.0}"
FROM	php:${PHP_VERSION}-fpm-alpine3.13

LABEL	maintainer="https://github.com/hermsi1337"

ARG     PHPREDIS_VERSION="${PHPREDIS_VERSION:-5.1.1}"
ENV     PHPREDIS_VERSION="${PHPREDIS_VERSION}"

#ADD     http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz /tmp/
#ADD     https://github.com/phpredis/phpredis/archive/${PHPREDIS_VERSION}.tar.gz /tmp/

RUN apk add --update npm

RUN     set -x                           && \
        \
        apk update                       && \
        \
        apk upgrade                      && \
        \
        docker-php-source extract        && \
        \
        apk add --no-cache                  \
            --virtual .build-dependencies   \
                $PHPIZE_DEPS                \
                cyrus-sasl-dev              \
                git                         \
                autoconf                    \
                g++                         \
                libtool                     \
                make                        \
                libgcrypt                   \
                pcre-dev                 && \
        \
        apk add --no-cache                  \
            tini                            \
            libintl                         \
            icu                             \
            icu-dev                         \
            libxml2-dev                     \
            postgresql-dev                  \
            freetype-dev                    \
            libjpeg-turbo-dev               \
            libpng-dev                      \
            gmp                             \
            gmp-dev                         \
            libmemcached-dev                \
            imagemagick-dev                 \
            libzip-dev                       \
            zlib-dev                        \
            libssh2-dev                     \
            libwebp-dev                     \
            libxpm-dev                      \
            libvpx-dev                      \
            libxslt-dev                     \
            libmcrypt-dev                && \
#        tar xfz /tmp/${PHPREDIS_VERSION}.tar.gz   && \
#        \
#        mv phpredis-$PHPREDIS_VERSION /usr/src/php/ext/redis    && \
#        \
        git clone https://github.com/php-memcached-dev/php-memcached.git /usr/src/php/ext/memcached/    && \
        \
        docker-php-ext-configure memcached      &&  \
        \
        docker-php-ext-configure exif           && \
        \
        docker-php-ext-configure gd             \
            --with-freetype=/usr/include/       \
            --with-xpm=/usr/include/            \
            --with-webp=/usr/include/           \
            --with-jpeg=/usr/include/       &&  \
        \
        docker-php-ext-install -j"$(getconf _NPROCESSORS_ONLN)" \
            intl                                                \
            bcmath                                              \
            xsl                                                 \
            zip                                                 \
            soap                                                \
            mysqli                                              \
            pdo                                                 \
            pdo_mysql                                           \
            pdo_pgsql                                           \
            gmp                                                 \
#            redis                                               \
            iconv                                               \
            gd                                                  \
            memcached                                       &&  \
#        \
#        tar -xvzf                                                       \
#            /tmp/ioncube_loaders_lin_x86-64.tar.gz                      \
#            -C /tmp/                                                &&  \
#        \
#        mkdir -p /usr/local/php/ext/ioncube                         &&  \
#        \
#        cp -a /tmp/ioncube/ioncube_loader_lin_${PHP_VERSION%.*}.so      \
#            /usr/local/php/ext/ioncube/ioncube_loader.so            &&  \
        \
        docker-php-ext-configure opcache --enable-opcache           &&  \
        \
        docker-php-ext-install opcache                              &&  \
        \
        docker-php-ext-install exif                                 &&  \
        \
        git clone \
            https://github.com/krakjoe/apcu.git \
            /usr/src/php/ext/apcu                                   &&  \
        git clone \
            https://github.com/Imagick/imagick.git \
            /usr/src/php/ext/imagick                                &&  \
        docker-php-ext-install apcu imagick                         &&  \
        docker-php-ext-enable apcu imagick                          &&  \
        \
        apk del .build-dependencies                                 &&  \
        \
        docker-php-source delete                                    &&  \
        \
        rm -rf /tmp/* /var/cache/apk/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version
#RUN chmod 777 /var/www/html/storage/ -R
