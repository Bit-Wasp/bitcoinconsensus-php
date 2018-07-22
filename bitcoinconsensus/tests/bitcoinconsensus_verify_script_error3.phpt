--TEST--
bitcoinconsensus_verify_script fails with error, amount required in segwit
--SKIPIF--
<?php
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
?>
--FILE--
<?php
$scriptPubKey = hex2bin("00140102030401020304010203040102030401020304");
$tx = hex2bin("010000000100000000000000000000000000000000000000000000000000000000000000000000000000ffffffff010065cd1d0000000017a91400000000000000000000000000000000000000008700000000");
$nIn = 0;
$flags = BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_ALL;
$error = 0;

$result = bitcoinconsensus_verify_script($scriptPubKey, $tx, $nIn, $flags, $error);
echo ($result == 1 ? "true" : "false") . PHP_EOL;
echo ($error === 0 ? "false" : "true") . PHP_EOL;
echo BITCOINCONSENSUS_ERR_AMOUNT_REQUIRED . PHP_EOL;
echo $error . PHP_EOL;
?>
--EXPECTF--
false
true
4
4
