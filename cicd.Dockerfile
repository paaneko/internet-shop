FROM php:8.2-fpm-alpine

# Add docker-php-extension-installer script
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install dependencies
RUN apk add --no-cache \
    bash \
    curl \
    freetype-dev \
    git \
    icu-dev \
    icu-libs \
    libc-dev \
    libzip-dev \
    make \
    mysql-client \
    nginx \
    oniguruma-dev \
    openssh-client \
    postgresql-libs \
    rsync \
    wget \
    zlib-dev

# The following dependencies have been commented out for image size reduction
# g++    gcc
# 25MB   118MB

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions \
    redis-stable \
    imagick-stable \
    xdebug-stable \
    bcmath \
    calendar \
    exif \
    gd \
    intl \
    pdo_mysql \
    pdo_pgsql \
    pcntl \
    soap \
    zip

# Add local and global vendor bin to PATH.
ENV PATH ./vendor/bin:/composer/vendor/bin:/root/.composer/vendor/bin:/usr/local/bin:$PATH

# Create directory for Nginx runtime
RUN mkdir -p /run/nginx

# Copy Nginx web server configuration
COPY nginx/nginx.conf /etc/nginx/nginx.conf
COPY nginx/startup.sh /run/nginx/startup.sh

# Create directory for Laravel application
RUN mkdir -p /var/www/

WORKDIR /var/www

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');"

COPY . /var/www/

RUN php /var/www/composer.phar install

RUN php artisan key:generate

# Change owner of web server files
RUN chown -R www-data:www-data /var/www

CMD sh /run/nginx/startup.sh

EXPOSE 80

