FROM php:7.2-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV APACHE_RUN_USER=dockeruser
ENV APACHE_RUN_GROUP=dockergroup

RUN addgroup dockergroup --gid 1000
RUN adduser --ingroup dockergroup --uid 1000 dockeruser --gecos "" --disabled-password
RUN apt-get update && apt-get install -y \
    libpq-dev git && docker-php-ext-install pdo pdo_pgsql

ENV COMPOSER_ALLOW_SUPERUSER 1
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

RUN mkdir -p /var/run/apache2 /var/www/project && \
    chown -R dockeruser:dockergroup /usr/sbin/apache2 /var/run/apache2 /var/www/project /var/log/apache2 && \
    sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf && \
    ln -sf /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load && \
    ln -sf /dev/stdout /var/log/apache2/access.log && \
    ln -sf /dev/stderr /var/log/apache2/error.log && \
    cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
    sed -ri -e 's!variables_order = "GPCS"!variables_order = "EGPCS"!' /usr/local/etc/php/php.ini
