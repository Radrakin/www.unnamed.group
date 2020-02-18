FROM alpine:3

WORKDIR /zeue/www.unnamed.group/

RUN apk add --update \
    npm git wget \
    && rm -rf /var/cache/apk/*

RUN wget -O /bin/caddy https://github.com/caddyserver/caddy/releases/download/v2.0.0-beta.14/caddy2_beta14_linux_amd64 && chmod +x /bin/caddy

COPY . .

RUN cd terminal && \
    npm install && \
    npm run build

CMD caddy run
