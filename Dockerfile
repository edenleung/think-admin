FROM xiaodi93/php:latest

ARG TZ="Asia/Shanghai"
ENV TZ ${TZ}

RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.aliyun.com/g' /etc/apk/repositories

RUN apk upgrade --update \
    && apk add bash tzdata \
    && ln -sf /usr/share/zoneinfo/${TZ} /etc/localtime \
    && echo ${TZ} > /etc/timezone \
    && rm -rf /var/cache/apk/*

COPY . /var/www/html

WORKDIR /var/www/html

RUN mv .env.example .env
RUN chmod -R 777 public/storage
RUN chmod -R 777 runtime

VOLUME [ "/var/www/html" ]