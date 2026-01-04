FROM php:8.2-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql

COPY . .

RUN php artisan key:generate || true

EXPOSE 8080

CMD php -S 0.0.0.0:${PORT} -t public
