FROM php:8.2-fpm

# Instalar NGINX y extensiones PHP necesarias
RUN apt-get update \
    && apt-get install -y --no-install-recommends nginx \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/* \
    && rm -f /etc/nginx/sites-enabled/default /etc/nginx/conf.d/default.conf

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto y configuracion de NGINX
COPY . /var/www/html/
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
