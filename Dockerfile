FROM php:8.2-apache

# Habilitar módulos de Apache
RUN a2enmod rewrite

# Configurar Apache para permitir acceso
RUN echo '<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
    </Directory>' > /etc/apache2/conf-available/docker-php.conf && \
    a2enconf docker-php

# Crear directorio y archivos con permisos
RUN mkdir -p /var/www/html/Ficheros && \
    touch /var/www/html/Ficheros/datos /var/www/html/Ficheros/jugadores && \
    chmod 777 /var/www/html/Ficheros && \
    chmod 666 /var/www/html/Ficheros/datos /var/www/html/Ficheros/jugadores

# Script para mantener permisos en runtime
RUN echo '#!/bin/bash\n\
    mkdir -p /var/www/html/Ficheros\n\
    touch /var/www/html/Ficheros/datos /var/www/html/Ficheros/jugadores\n\
    chmod 777 /var/www/html/Ficheros\n\
    chmod 666 /var/www/html/Ficheros/datos /var/www/html/Ficheros/jugadores\n\
    chown -R www-data:www-data /var/www/html/Ficheros\n\
    exec apache2-foreground' > /usr/local/bin/start.sh && \
    chmod +x /usr/local/bin/start.sh

WORKDIR /var/www/html

CMD ["/usr/local/bin/start.sh"]
