FROM alpine:3.8

RUN apk add --update --no-cache util-linux nodejs nodejs-npm

COPY . ./uagpmc.com

RUN cd uagpmc.com && \
      npm install && \
      npm run build

EXPOSE 80/tcp

CMD cd uagpmc.com && npm run start
