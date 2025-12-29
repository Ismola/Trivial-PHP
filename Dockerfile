FROM php:8.2-apache

# Habilitar módulo rewrite de Apache
RUN a2enmod rewrite

# Copiar configuración de Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copiar los archivos del proyecto
COPY . /var/www/html/

# Copiar el script de entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Cambiar permisos iniciales
RUN mkdir -p /var/www/html/Ficheros && \
    touch /var/www/html/Ficheros/datos /var/www/html/Ficheros/jugadores && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod 666 /var/www/html/Ficheros/datos /var/www/html/Ficheros/jugadores

WORKDIR /var/www/html

ENTRYPOINT ["/entrypoint.sh"]
