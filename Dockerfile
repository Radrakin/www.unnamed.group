FROM alpine:3

WORKDIR /app/

RUN apk add --update \
    npm git curl bash \
    && rm -rf /var/cache/apk/*

RUN curl https://getcaddy.com | bash -s personal

COPY . .

RUN cd arma3/terminal && \
    npm install && \
    npm run build

RUN cd terminal && \
    npm install && \
    npm run build

CMD caddy
