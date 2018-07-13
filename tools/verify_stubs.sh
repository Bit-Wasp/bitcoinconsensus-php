#!/bin/bash
cd $(git rev-parse --show-toplevel)

if [ "${COVERAGE}" = "true" ]; then
    tools/generate_stubs.sh

    cmp --silent stubs/const.php tools/stubs/output/const.php

    if [ $? -eq 0 ]
    then
        echo "const file ok";
    else
        echo "const file not up to date";
        diff stubs/const.php tools/stubs/output/const.php
        exit -1;
    fi

    cmp --silent stubs/functions.php tools/stubs/output/functions.php

    if [ $? -eq 0 ]
    then
        echo "functions file ok";
    else
        echo "functions file not up to date";
        diff stubs/functions.php tools/stubs/output/functions.php
        exit -1;
    fi
fi
