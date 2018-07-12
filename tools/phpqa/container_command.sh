#!/bin/bash
_PHPQA_DIR=$(git rev-parse --show-toplevel)/tools/phpqa
_GCOV_DIR=${_PHPQA_DIR}/output
_EXT_DIR=$(git rev-parse --show-toplevel)/bitcoinconsensus
_CMD=$1

rm -rf ${_GCOV_DIR}
docker build -t bitcoinconsensusbuild .
docker run -it \
     -v ${_GCOV_DIR}:/usr/src/php/lcov_html \
     -v ${_EXT_DIR}:/usr/src/php/ext/bitcoinconsensus \
     --name s1 bitcoinconsensusbuild ${_CMD}
