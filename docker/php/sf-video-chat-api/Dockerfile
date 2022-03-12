FROM php_base

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY vhost.conf /etc/apache2/sites-available/vhost.conf

RUN a2enmod rewrite && \
    a2ensite vhost && \
    service apache2 restart

CMD composer install && \
    chmod -R 777 var/ && \
    cp .env .env.local && \
    php bin/console lexik:jwt:generate-keypair --skip-if-exists && \
    php bin/console doctrine:database:create --if-not-exists && \
    apache2-foreground