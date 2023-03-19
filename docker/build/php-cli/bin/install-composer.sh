#!/bin/bash
set -e

# Install whatever relies upon docker env variables in this script.

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
chmod +x /usr/local/bin/composer
composer self-update
