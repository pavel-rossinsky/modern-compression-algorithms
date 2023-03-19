FROM ubuntu:20.04

ARG PHP_VERSION=8.1

# otherwise, you can't install PHP without setting a timezone interactively
ARG DEBIAN_FRONTEND=noninteractive

RUN apt update -y && \
    apt upgrade -y && \
    apt-get install -y less && \
    apt-get install -y git

RUN apt install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt update -y 

RUN apt-get install -y php${PHP_VERSION} && \
    apt-get install -y php${PHP_VERSION}-zip && \
    apt-get install -y php${PHP_VERSION}-xdebug && \
    apt-get install -y php${PHP_VERSION}-dev 

COPY bin /usr/local/bin

RUN install-kjdev-php-ext.sh ${PHP_VERSION} "zstd"
RUN install-kjdev-php-ext.sh ${PHP_VERSION} "lz4"
RUN install-kjdev-php-ext.sh ${PHP_VERSION} "brotli"
RUN install-kjdev-php-ext.sh ${PHP_VERSION} "snappy"
RUN install-kjdev-php-ext.sh ${PHP_VERSION} "bzip3"

#RUN apt-get install -y liblzma-dev
#RUN install-kjdev-php-ext.sh ${PHP_VERSION} "xz"

#RUN apt-get install -y libz-dev
#RUN install-kjdev-php-ext.sh ${PHP_VERSION} "zopfli"

COPY etc/php/ /etc/php/${PHP_VERSION}/

#RUN install-composer.sh

USER www-data:www-data
WORKDIR /var/www/html

ENTRYPOINT ["entrypoint.sh"]

CMD ["tail", "-f", "/dev/null"]
