FROM php:7.2-alpine

ARG MONGODB_URL
ENV MONGODB_URL ${MONGODB_URL}

ARG OAUTH_DISCORD_CLIENT_ID
ENV OAUTH_DISCORD_CLIENT_ID ${OAUTH_DISCORD_CLIENT_ID}

ARG OAUTH_DISCORD_CLIENT_SECRET
ENV OAUTH_DISCORD_CLIENT_SECRET ${OAUTH_DISCORD_CLIENT_SECRET}

ARG MAILER_URL
ENV MAILER_URL ${MAILER_URL}

RUN echo 'http://dl-cdn.alpinelinux.org/alpine/v3.6/main' >> /etc/apk/repositories
RUN echo 'http://dl-cdn.alpinelinux.org/alpine/v3.6/community' >> /etc/apk/repositories

RUN apk add --update --no-cache libressl-dev util-linux composer zip libpng-dev git mongodb alpine-sdk autoconf python nodejs yarn npm && \
        docker-php-ext-install pcntl mysqli pdo gd zip

RUN pecl install mongodb

RUN docker-php-ext-enable mongodb

RUN mkdir /unnamed.group

COPY . /unnamed.group/

RUN cd /unnamed.group && \
      cp .env.prod .env && \
      composer install

RUN cd /unnamed.group/vuepress/ && \
      npm i && npm run build && cp -r public-inject/* public/ && \
      mkdir /unnamed.group/public/handbook/ && cp -r public/* /unnamed.group/public/handbook/

CMD php /unnamed.group/bin/console server:run *:$PORT
