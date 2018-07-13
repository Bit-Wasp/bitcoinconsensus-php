--TEST--
bitcoinconsensus_verify_script fails with error, tx index
--SKIPIF--
<?php
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
?>
--FILE--
<?php
$scriptPubKey = hex2bin("51");
$tx = hex2bin("010000000100000000000000000000000000000000000000000000000000000000000000000000000000ffffffff010065cd1d0000000017a91400000000000000000000000000000000000000008700000000");
// tx only has 1 input, second doesn't exist
$nIn = 2;
$flags = 0;
$error = 0;

$result = bitcoinconsensus_verify_script($scriptPubKey, $tx, $nIn, $flags, $error);
echo ($result == 1 ? "true" : "false") . PHP_EOL;
echo ($error === 0 ? "false" : "true") . PHP_EOL;
echo BITCOINCONSENSUS_ERR_TX_INDEX . PHP_EOL;
echo $error . PHP_EOL;
?>
--EXPECTF--
false
true
1
1
