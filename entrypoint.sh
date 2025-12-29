#!/bin/bash

# Asegurar que existen los archivos
mkdir -p /var/www/html/Ficheros
touch /var/www/html/Ficheros/datos
touch /var/www/html/Ficheros/jugadores

# Asegurar permisos correctos para todo el proyecto
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html
chmod 666 /var/www/html/Ficheros/datos
chmod 666 /var/www/html/Ficheros/jugadores

# Crear directorios de logs si no existen
mkdir -p /var/log/nginx
chown -R www-data:www-data /var/log/nginx

# Iniciar PHP-FPM en segundo plano
php-fpm -D

# Iniciar Nginx en primer plano
nginx -g 'daemon off;'
