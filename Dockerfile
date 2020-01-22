FROM alpine:3

WORKDIR /zeue/www.unnamed.group/

RUN apk add --update \
    curl bash \
    npm \
    && rm -rf /var/cache/apk/*

RUN CADDY_TELEMETRY=on curl https://getcaddy.com | bash -s personal http.cache,http.nobots,http.ratelimit,http.realip,http.s3browser

COPY . .

RUN cd handbook && \
    npm install && \
    npm run build

CMD [ "caddy" ]