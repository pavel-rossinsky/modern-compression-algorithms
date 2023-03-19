#!/bin/bash
set -ex

if [[ -z $1 ]]; then
    echo "PHP_VERSION is not set"
    exit 1
else
    PHP_VERSION=$1
fi

cd /usr/local/src

git clone --recursive --depth=1 https://github.com/kjdev/php-ext-zstd.git && cd "$(basename "$_" .git)"
phpize
./configure
make
TEST_PHP_ARGS=-q make test
make install

echo "extension=zstd.so" > "/etc/php/${PHP_VERSION}/mods-available/zstd.ini"
phpenmod -v "${PHP_VERSION}" zstd