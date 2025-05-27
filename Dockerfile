# Usa a imagem oficial do PHP 8.2 com FPM (para Nginx)
FROM php:8.2-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Limpa o cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala extensões do PHP necessárias para o Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cria diretório para a aplicação
WORKDIR /var/www

# Copia os arquivos do projeto (exceto o que está no .dockerignore)
COPY . .

# Instala as dependências do Composer (sem scripts para evitar erros)
RUN composer install --no-interaction --no-scripts

# Permissões para o Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expose port 9000 (PHP-FPM)
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]