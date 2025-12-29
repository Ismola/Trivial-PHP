FROM php:8.2-fpm

# Instalar nginx y supervisor
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    && rm -rf /var/lib/apt/lists/*

# Copiar archivos del proyecto
COPY . /var/www/html/

# Copiar configuración de nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf
RUN rm -f /etc/nginx/sites-enabled/default

# Copiar configuración de supervisor
RUN echo "[supervisord]\n\
    nodaemon=true\n\
    \n\
    [program:php-fpm]\n\
    command=/usr/local/sbin/php-fpm --nodaemonize\n\
    autostart=true\n\
    autorestart=true\n\
    \n\
    [program:nginx]\n\
    command=/usr/sbin/nginx -g 'daemon off;'\n\
    autostart=true\n\
    autorestart=true" > /etc/supervisor/conf.d/supervisord.conf

# Crear directorio de Ficheros y establecer permisos
RUN mkdir -p /var/www/html/Ficheros && \
    touch /var/www/html/Ficheros/datos /var/www/html/Ficheros/jugadores && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod 777 /var/www/html/Ficheros && \
    chmod 666 /var/www/html/Ficheros/datos /var/www/html/Ficheros/jugadores

WORKDIR /var/www/html

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
