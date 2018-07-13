--TEST--
bitcoinconsensus_verify_script returns true with no error
--SKIPIF--
<?php
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
?>
--FILE--
<?php
$scriptPubKey = hex2bin("51");
$tx = hex2bin("010000000100000000000000000000000000000000000000000000000000000000000000000000000000ffffffff010065cd1d0000000017a91400000000000000000000000000000000000000008700000000");
$nIn = 0;
$flags = 0;
$error = 0;

$result = bitcoinconsensus_verify_script($scriptPubKey, $tx, $nIn, $flags, $error);
echo ($result == 1 ? "true" : "false") . PHP_EOL;
echo ($error === 0 ? "false" : "true") . PHP_EOL;
?>
--EXPECTF--
true
false
