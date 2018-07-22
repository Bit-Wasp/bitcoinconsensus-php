#!/bin/bash

_LIVE=$1
[ "${_LIVE}" = "live" ] || _LIVE=false

cd $(git rev-parse --show-toplevel)/tools/stubs

if [ ! -d php-extension-stub-generator ]; then
    git clone -b mods-secp256k1-stubs https://github.com/afk11/php-extension-stub-generator
fi

if [ ! -d php-extension-stub-generator/vendor ]; then
    cd php-extension-stub-generator
    composer install
    cd ../
fi

if [ "${_LIVE}" = "live" ]; then
    _STUBSOUT=$(git rev-parse --show-toplevel)/stubs
else
    _STUBSOUT=$(git rev-parse --show-toplevel)/tools/stubs/output
    [ -d "${_STUBSOUT}" ] || mkdir output
fi

echo "generated stubs to ${_STUBSOUT}"
php -dextension=bitcoinconsensus.so php-extension-stub-generator/bin/docblock-stub-generator dump-files --docBlock=config.json bitcoinconsensus ${_STUBSOUT} <<< $'y'

