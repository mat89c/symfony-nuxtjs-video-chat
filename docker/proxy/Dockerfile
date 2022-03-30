FROM php_base

COPY ports.conf /etc/apache2/ports.conf

COPY video-chat.pl.conf /etc/apache2/sites-available/

COPY api.video-chat.pl.conf /etc/apache2/sites-available/

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" && \
    a2enmod rewrite && \
    a2enmod proxy && \
    a2enmod proxy_http && \
    a2enmod proxy_fcgi && \
    a2enmod proxy_balancer && \
    a2enmod lbmethod_byrequests && \
    a2enmod proxy_wstunnel &&\
    a2enmod headers &&  \
    a2enmod proxy_ajp && \
    a2ensite * && \
    a2dissite 000-default.conf && \
    a2dissite default-ssl.conf && \
    service apache2 restart

CMD apache2-foreground