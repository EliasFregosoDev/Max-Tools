FROM php:8.1-cli

WORKDIR /app

COPY . .

EXPOSE $PORT

CMD ["php", "-S", "0.0.0.0:$PORT", "-t", "public"]