FROM alpine:3

WORKDIR /app/

RUN apk add --update \
    npm curl bash \
    && rm -rf /var/cache/apk/*

RUN curl https://getcaddy.com | bash -s personal

COPY . .

RUN cd ./src/arma3/ && npm i && npm run build

CMD caddy
