FROM php_base

COPY php.ini-development "$PHP_INI_DIR/php.ini"

COPY vhost.conf /etc/apache2/sites-available/vhost.conf

RUN a2enmod rewrite && \
    a2ensite vhost && \
    service apache2 restart

CMD composer install && \
    chmod -R 777 var/ && \
    cp .env .env.local && \
    php bin/console lexik:jwt:generate-keypair --skip-if-exists && \
    php bin/console doctrine:database:create --connection=user --if-not-exists && \
    php bin/console doctrine:database:create --connection=chat --if-not-exists && \
    php bin/console doctrine:migrations:migrate --configuration=src/Core/UserAuth/Infrastructure/Persistence/Doctrine/config/doctrine_migrations.yaml && \
    php bin/console doctrine:migrations:migrate --configuration=src/Core/Chat/Infrastructure/Persistence/Doctrine/config/doctrine_migrations.yaml && \
    apache2-foreground