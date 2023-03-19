FROM ubuntu:20.04

ARG PHP_VERSION=8.1

# otherwise, you can't install PHP without setting a timezone interactively
ARG DEBIAN_FRONTEND=noninteractive

RUN apt update -y && \
    apt upgrade -y && \
    apt-get install -y less

RUN apt install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt update -y 

RUN apt-get install -y php${PHP_VERSION} && \
    apt-get install -y php${PHP_VERSION}-zip && \
    apt-get install -y php${PHP_VERSION}-xdebug

COPY bin /usr/local/bin
COPY etc/php/ /etc/php/${PHP_VERSION}/

#RUN install-composer.sh

USER www-data:www-data
WORKDIR /var/www/html

ENTRYPOINT ["entrypoint.sh"]

CMD ["tail", "-f", "/dev/null"]
