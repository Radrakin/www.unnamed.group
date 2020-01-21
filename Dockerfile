FROM alpine:3

WORKDIR /zeue/www.unnamed.group/

RUN apk add --update \
    curl bash \
    && rm -rf /var/cache/apk/*

RUN curl https://getcaddy.com | bash -s personal

COPY . .

CMD [ "caddy" ]