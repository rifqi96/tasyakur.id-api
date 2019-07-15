FROM php:7.3-fpm-alpine

# Initiate required env vars at build time
ARG PHP_OPCACHE_VALIDATE_TIMESTAMPS=${PHP_OPCACHE_VALIDATE_TIMESTAMPS}
# ENV is optional, without it the variable only exists at build time
# Add ENV at run time
ENV USER www
ENV GROUP www
ENV UID 1000
ENV GID 1000
ENV USERDIR /var/${USER}
ENV WORKDIR ${USERDIR}/html
ENV ETCDIR ./etc/php
ENV PORT 9000

# Set working directory
WORKDIR ${WORKDIR}

# Copy out app source code to the container
ADD ./src ${WORKDIR}

RUN docker-php-ext-install mysqli

# Add repos to alpine's apk
RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories
RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories

# Install required apk packages
RUN apk update && \
    apk upgrade && \
    apk add --no-cache \
    $PHPIZE_DEPS \
    bash \
    ssmtp \
    libpng libpng-dev \
    zlib zlib-dev \
    libzip libzip-dev \
    icu icu-dev \
    jpegoptim optipng pngquant gifsicle \
    imagemagick imagemagick-libs imagemagick-dev \
    libffi-dev \
    zip unzip curl g++
    # apk add --no-cache sendmail libpng-dev zlib1g-dev libzip-dev libmagickwand-dev

# Install extensions from docker php ext
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
# RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip

# Install and enable imagemagick
RUN pecl install imagick && \
    docker-php-ext-enable imagick

# Install opcache
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=${PHP_OPCACHE_VALIDATE_TIMESTAMPS} \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"
RUN docker-php-ext-install opcache
COPY ${ETCDIR}/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for the php application
# RUN groupadd -g ${GID} ${GROUP}
# RUN useradd -u ${UID} -ms /bin/bash -g ${GROUP} ${USER}
RUN addgroup -g ${GID} -S ${GROUP} && \
    adduser -u ${UID} -S ${USER} -G ${GROUP}

# Copy existing application directory permissions
RUN chown -R ${USER}:${USER} ${USERDIR}

# Copy all conf files
COPY ${ETCDIR}/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ${ETCDIR}/uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY ${ETCDIR}/logs.ini /usr/local/etc/php/conf.d/logs.ini

# Expose port 9000 and start php-fpm server
EXPOSE ${PORT}
CMD ["php-fpm"]

# END