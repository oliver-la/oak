FROM    richarvey/nginx-php-fpm:latest
ENV     WEBROOT /var/www/html/public
ADD     . /var/www/html/
RUN     cd /var/www/html/ && \
        composer install && \
        mv settings.example.php settings.php
CMD     ["/start.sh"]