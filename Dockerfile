FROM php:8.2-fpm

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    nginx \
    && rm -rf /var/lib/apt/lists/*

# Copiar configuración de nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Copiar los archivos del proyecto
COPY . /var/www/html/

# Copiar el script de entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Cambiar permisos
RUN mkdir -p /var/www/html/Ficheros && \
    touch /var/www/html/Ficheros/datos /var/www/html/Ficheros/jugadores && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod 666 /var/www/html/Ficheros/datos /var/www/html/Ficheros/jugadores

WORKDIR /var/www/html

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
