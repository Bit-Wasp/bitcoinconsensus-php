--TEST--
bitcoinconsensus_verify_script fails with error, invalid flags provided
--SKIPIF--
<?php
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
if (!defined("BITCOINCONSENSUS_ERR_INVALID_FLAGS")) print "skip BITCOINCONSENSUS_ERR_INVALID_FLAGS constant missing";
?>
--FILE--
<?php
$scriptPubKey = hex2bin("51");
$tx = hex2bin("010000000100000000000000000000000000000000000000000000000000000000000000000000000000ffffffff010065cd1d0000000017a91400000000000000000000000000000000000000008700000000");
$nIn = 0;
$flags = 1 << 7;
$error = 0;

$result = bitcoinconsensus_verify_script($scriptPubKey, $tx, $nIn, $flags, $error);
echo ($result == 5 ? "flags error" : "not flags error") . PHP_EOL;
echo ($error === 0 ? "expected" : "unexpected") . PHP_EOL;
echo BITCOINCONSENSUS_ERR_INVALID_FLAGS . PHP_EOL;
echo $result . PHP_EOL;
echo $error . PHP_EOL;
?>
--EXPECTF--
flags error
expected
5
5
0
