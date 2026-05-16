FROM php:8.1-cli

# Instalar extensiones de PostgreSQL
RUN apt-get update && apt-get install -y \
    postgresql-client \
    libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql \
    && apt-get clean

WORKDIR /app

COPY . .

CMD sh -c 'php -S 0.0.0.0:$PORT -t public'