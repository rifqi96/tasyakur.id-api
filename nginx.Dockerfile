FROM nginx:1.17-alpine

ARG APP_ENV=${APP_ENV}

ENV APP_ENV ${APP_ENV}
ENV WORKDIR /var/www/html
ENV ETCDIR ./etc/nginx
ENV CONFDIR /etc/nginx/conf.d
ENV CONFTEMPLDIR /etc/nginx/conf-template.d

ADD ./src ${WORKDIR}

COPY ${ETCDIR}/*.conf /etc/nginx/conf-template.d/

RUN apk update && \
    apk upgrade && \
    apk add --no-cache \
    bash

# Override the default.conf nginx file
RUN if [ "$APP_ENV" = "production" ] || [ "$APP_ENV" = "staging" ]; \
        then cp ${CONFTEMPLDIR}/default.conf ${CONFDIR}/default.conf; \
    else \
        cp ${CONFTEMPLDIR}/default.conf ${CONFDIR}/default.conf; \
    fi

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]