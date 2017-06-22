<?php

namespace {
    define("BITCOINCONSENSUS_VERIFY_NONE", 0);
    define("BITCOINCONSENSUS_VERIFY_P2SH", 1 << 0);
    define("BITCOINCONSENSUS_VERIFY_DERSIG", 1 << 2);
    define("BITCOINCONSENSUS_VERIFY_NULLDUMMY", 1 << 4);
    define("BITCOINCONSENSUS_VERIFY_CHECKLOCKTIMEVERIFY", 1 << 9);
    define("BITCOINCONSENSUS_VERIFY_CHECKSEQUENCEVERIFY", 1 << 9);
    define("BITCOINCONSENSUS_VERIFY_WITNESS", 1 << 10);
    define("BITCOINCONSENSUS_VERIFY_ALL", BITCOINCONSENSUS_VERIFY_NONE |
        BITCOINCONSENSUS_VERIFY_P2SH |
        BITCOINCONSENSUS_VERIFY_DERSIG |
        BITCOINCONSENSUS_VERIFY_NULLDUMMY |
        BITCOINCONSENSUS_VERIFY_CHECKLOCKTIMEVERIFY |
        BITCOINCONSENSUS_VERIFY_CHECKSEQUENCEVERIFY |
        BITCOINCONSENSUS_VERIFY_WITNESS
    );

    /**
     * @return int
     */
    function bitcoinconsensus_version() {
    }

    /**
     * @param string $scriptPubKey
     * @param int $amount
     * @param string $transaction
     * @param int $nInput
     * @param int $flags
     * @param int $error
     * @return bool
     */
    function bitcoinconsensus_verify_script_with_amount($scriptPubKey, $amount, $transaction, $nInput, $flags, &$error) {

    }

    /**
     * @param string $scriptPubKey
     * @param string $transaction
     * @param int $nInput
     * @param int $flags
     * @param int $error
     * @return bool
     */
    function bitcoinconsensus_verify_script($scriptPubKey, $transaction, $nInput, $flags, &$error) {

    }
}

