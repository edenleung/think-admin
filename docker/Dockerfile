FROM xiaodi93/dcnmp-php71:latest

ARG TZ="Asia/Shanghai"
ENV TZ ${TZ}

RUN apk upgrade --update \
    && apk add bash tzdata \
    && ln -sf /usr/share/zoneinfo/${TZ} /etc/localtime \
    && echo ${TZ} > /etc/timezone \
    && rm -rf /var/cache/apk/*

COPY . /var/www/html

RUN mv .env.example .env
RUN chmod -R 775 public/storage
RUN chmod -R 775 runtime

EXPOSE 8000

CMD php think run