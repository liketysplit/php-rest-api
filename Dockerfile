FROM php:latest

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app
RUN rm database/database.sqlite
RUN rm .env
RUN mv .env_sqlite .env
RUN touch database/database.sqlite
RUN composer install
RUN php artisan migrate
CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000