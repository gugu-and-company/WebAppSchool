FROM php:7.4-alpine

RUN apk --update add tzdata && \
    cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
    apk del tzdata && \
    rm -rf /var/cache/apk/*

RUN apk --update add oniguruma-dev && \
    rm -rf /var/cache/apk/*

RUN docker-php-ext-install mbstring

COPY ./php/php.ini-development /usr/local/etc/php/php.ini

WORKDIR /work

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/src/web"]
