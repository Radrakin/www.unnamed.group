FROM node:10-alpine

COPY . ./loadouts.uagpmc.com

RUN cd loadouts.uagpmc.com && npm i

EXPOSE 80/tcp

CMD cd loadouts.uagpmc.com && npm start
