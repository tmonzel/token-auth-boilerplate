FROM node:lts-alpine

ENV APP_ROOT /app

RUN mkdir ${APP_ROOT}
WORKDIR ${APP_ROOT}

COPY package*.json ${APP_ROOT}/
RUN npm install

COPY . ${APP_ROOT}
RUN npm run build

ENV HOST 0.0.0.0

CMD [ "npm", "start" ]