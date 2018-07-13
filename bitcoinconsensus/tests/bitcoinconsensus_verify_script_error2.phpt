--TEST--
bitcoinconsensus_verify_script fails with error, tx serialization
--SKIPIF--
<?php
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
?>
--FILE--
<?php
$scriptPubKey = hex2bin("");
$tx = hex2bin("01000000");
$nIn = 0;
$flags = 0;
$error = 0;

$result = bitcoinconsensus_verify_script($scriptPubKey, $tx, $nIn, $flags, $error);
echo ($result == 1 ? "true" : "false") . PHP_EOL;
echo ($error === 0 ? "false" : "true") . PHP_EOL;
echo BITCOINCONSENSUS_ERR_TX_DESERIALIZE . PHP_EOL;
echo $error . PHP_EOL;
?>
--EXPECTF--
false
true
3
3
