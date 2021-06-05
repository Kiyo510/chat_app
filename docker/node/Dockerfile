FROM node:lts-alpine
RUN mkdir -p /var/www/nuxt
# timezone
ARG TZ
WORKDIR /var/www/nuxt
COPY ./nuxt/ /var/www/nuxt/

RUN apk update && \
  apk upgrade && \
  apk add --no-cache make gcc g++ python && \
  yarn install

EXPOSE 3000

ENTRYPOINT ["yarn", "run", "dev"]
