#!/bin/bash
set -ex

if [[ -z $1 ]]; then
    echo "PHP_VERSION is not set"
    exit 1
else
    PHP_VERSION=$1
fi

if [[ -z $2 ]]; then
    echo "EXTENSION_NAME is not set"
    exit 1
else
    EXTENSION_NAME=$2
fi

cd /usr/local/src

git clone --recursive --depth=1 "https://github.com/kjdev/php-ext-${EXTENSION_NAME}.git" && cd "$(basename "$_" .git)"
phpize
./configure
make
TEST_PHP_ARGS=-q make test
make install

echo "extension=${EXTENSION_NAME}.so" > "/etc/php/${PHP_VERSION}/mods-available/${EXTENSION_NAME}.ini"
phpenmod -v "${PHP_VERSION}" "${EXTENSION_NAME}"
