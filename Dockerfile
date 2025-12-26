# 1. Usar imagen base de PHP 8.2 con Apache
FROM php:8.2-apache

# 2. Instalar dependencias del sistema necesarias
# IMPORTANTE: Incluimos libpq-dev para que funcione PostgreSQL (Neon)
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    git \
    unzip \
    && docker-php-ext-install \
    intl \
    zip \
    pdo \
    pdo_pgsql \
    pgsql \
    opcache

# 3. Activar mod_rewrite de Apache (Vital para las rutas de CodeIgniter)
RUN a2enmod rewrite

# 4. Configurar Apache para que apunte a la carpeta /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 5. Instalar Composer (Gestor de paquetes de PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Definir directorio de trabajo
WORKDIR /var/www/html

# 7. Copiar los archivos del proyecto al contenedor
COPY . .

# 8. Instalar dependencias de CodeIgniter
RUN composer install --no-dev --optimize-autoloader

# 9. Dar permisos a la carpeta de escritura (Logs, Cache)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/writable

# 10. Exponer el puerto 80 (Render usa este por defecto internamente)
EXPOSE 80