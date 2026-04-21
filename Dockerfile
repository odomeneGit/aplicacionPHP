FROM php:8.4-apache

# Instalar extensiones para MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Activar mod_rewrite
RUN a2enmod rewrite

# Copiar la aplicación
COPY ./src /var/www/html/

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 755 /var/www/html

# Configurar Apache para permitir acceso a todos los archivos
RUN echo '<Directory /var/www/html>' >> /etc/apache2/apache2.conf \
 && echo '    Options Indexes FollowSymLinks' >> /etc/apache2/apache2.conf \
 && echo '    AllowOverride All' >> /etc/apache2/apache2.conf \
 && echo '    Require all granted' >> /etc/apache2/apache2.conf \
 && echo '</Directory>' >> /etc/apache2/apache2.conf

# Evitar warning de ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80
