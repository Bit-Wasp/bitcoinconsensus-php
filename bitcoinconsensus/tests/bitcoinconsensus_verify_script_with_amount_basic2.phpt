--TEST--
bitcoinconsensus_verify_script_with_amount returns false with no error
--SKIPIF--
<?php
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
if (!function_exists("bitcoinconsensus_verify_script_with_amount")) print "skip bitcoinconsensus_verify_script_with_amount not defined";
?>
--FILE--
<?php
$scriptPubKey = hex2bin("00");
$tx = hex2bin("010000000100000000000000000000000000000000000000000000000000000000000000000000000000ffffffff010065cd1d0000000017a91400000000000000000000000000000000000000008700000000");
$nIn = 0;
$amount = 0;
$flags = BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_WITNESS | BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_P2SH;
$error = 0;

$result = bitcoinconsensus_verify_script_with_amount($scriptPubKey, $amount, $tx, $nIn, $flags, $error);
echo ($result == 1 ? "true" : "false") . PHP_EOL;
echo ($error === 0 ? "false" : "true") . PHP_EOL;
?>
--EXPECTF--
false
false
