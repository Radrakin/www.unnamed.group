FROM php:7.2-alpine

ARG MONGODB_URL
ENV MONGODB_URL ${MONGODB_URL}

ARG OAUTH_DISCORD_CLIENT_ID
ENV OAUTH_DISCORD_CLIENT_ID ${OAUTH_DISCORD_CLIENT_ID}

ARG OAUTH_DISCORD_CLIENT_SECRET
ENV OAUTH_DISCORD_CLIENT_SECRET ${OAUTH_DISCORD_CLIENT_SECRET}

ARG MAILER_URL
ENV MAILER_URL ${MAILER_URL}

RUN apk add --update --no-cache util-linux composer zip libpng-dev git mongodb alpine-sdk autoconf && \
        docker-php-ext-install pcntl mysqli pdo gd zip

RUN pecl install mongodb

RUN docker-php-ext-enable mongodb

RUN mkdir uagpmc.com

COPY . ./uagpmc.com

RUN cd uagpmc.com && \
      cp .env.prod .env && \
      composer install

EXPOSE 80/tcp

CMD php uagpmc.com/bin/console server:run *:80
