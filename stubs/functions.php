<?php
/**
 * auto generated file by PHPExtensionStubGenerator
 */

/**
 * Returns the bitcoinconsensus version.
 * 
 * @return mixed
 */
function bitcoinconsensus_version() {}
/**
 * Returns 1 if the input nIn of the serialized transaction pointed to by
 * txTo correctly spends the scriptPubKey pointed to by scriptPubKey under
 * the additional constraints specified by flags.
 * If not nullptr, err will contain an error/success code for the operation.
 * 
 * @param string $scriptPubKey
 * @param string $transaction
 * @param int $nInput
 * @param int $flags
 * @param int $errorFlag
 * @return int
 */
function bitcoinconsensus_verify_script(string $scriptPubKey, string $transaction, int $nInput, int $flags, int &$errorFlag): int {}
/**
 * Returns 1 if the input nIn of the serialized transaction pointed to by
 * txTo correctly spends the scriptPubKey pointed to by scriptPubKey under
 * the additional constraints specified by flags.
 * If not nullptr, err will contain an error/success code for the operation.
 * This function must be used when the input uses segregated witness.
 * @param string $scriptPubKey
 * @param int $amount
 * @param string $transaction
 * @param int $nInput
 * @param int $flags
 * @param int $errorFlag
 * @return int
 */
function bitcoinconsensus_verify_script_with_amount(string $scriptPubKey, int $amount, string $transaction, int $nInput, int $flags, int &$errorFlag): int {}