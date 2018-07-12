#!/bin/bash

exitHard=false
if [ "${COVERAGE}" = "true" ]; then
    cd $(git rev-parse --show-toplevel)/bitcoinconsensus
    sudo make clean
    cd $(git rev-parse --show-toplevel)/tools/phpqa
    ./container_command.sh coverage.sh
    if [ "$?" != "0" ]; then
        exitHard=true
    fi
    docker stop s1 > /dev/null;
    docker rm s1 > /dev/null;
    echo "completed coverage command";
fi

if [ "${exitHard}" = "true" ]; then
    echo "received error from coverage.sh"
    exit 1;
fi

exit 0;
