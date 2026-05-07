FROM php:8.3-apache-bookworm

ARG MOODLE_DOWNLOAD_URL=https://download.moodle.org/download.php/direct/stable502/moodle-5.2.tgz

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        libcurl4-openssl-dev \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev \
        libxml2-dev \
        libxslt1-dev \
        libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        curl \
        exif \
        gd \
        intl \
        mbstring \
        mysqli \
        opcache \
        soap \
        xml \
        xsl \
        zip \
    && a2enmod rewrite headers expires \
    && mkdir -p /usr/src/moodle /tmp/moodle-extract \
    && curl -fsSL --retry 5 --retry-delay 3 "${MOODLE_DOWNLOAD_URL}" -o /tmp/moodle.tgz \
    && tar -xzf /tmp/moodle.tgz -C /tmp/moodle-extract \
    && if [ -d /tmp/moodle-extract/moodle ]; then src=/tmp/moodle-extract/moodle; else src=/tmp/moodle-extract; fi \
    && cp -a "${src}"/. /usr/src/moodle/ \
    && find /var/www/html -mindepth 1 -maxdepth 1 -exec rm -rf {} + \
    && cp -a /usr/src/moodle/. /var/www/html/ \
    && chown -R www-data:www-data /var/www/html \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/moodle.tgz /tmp/moodle-extract /usr/src/moodle/.git

COPY docker/apache-moodle.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/moodle.ini
COPY docker/docker-entrypoint-moodle.sh /usr/local/bin/docker-entrypoint-moodle

RUN sed -i 's/\r$//' /usr/local/bin/docker-entrypoint-moodle \
    && chmod +x /usr/local/bin/docker-entrypoint-moodle

ENTRYPOINT ["docker-entrypoint-moodle"]
