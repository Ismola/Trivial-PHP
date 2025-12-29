#!/bin/bash

# Asegurar que existen los archivos
mkdir -p /var/www/html/Ficheros
touch /var/www/html/Ficheros/datos
touch /var/www/html/Ficheros/jugadores

# Asegurar permisos correctos
chown -R www-data:www-data /var/www/html/Ficheros
chmod 755 /var/www/html/Ficheros
chmod 666 /var/www/html/Ficheros/datos
chmod 666 /var/www/html/Ficheros/jugadores

# Iniciar Apache
apache2-foreground
