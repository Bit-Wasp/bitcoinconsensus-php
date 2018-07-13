--TEST--
bitcoinconsensus_verify_script returns false when script does (no error?)
--SKIPIF--
<?php
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
?>
--FILE--
<?php
$scriptPubKey = hex2bin("0564756d6d7904736967315103706b3151ae635168");
$tx = hex2bin("0100000001fc86a93cb66ae855f4e26b0ad89f07037dbfeff00dd058daab65aced9212e4580000000000ffffffff0100000000000000000000000000");
$nIn = 0;
$flags = 0;
$error = 0;

$result = bitcoinconsensus_verify_script($scriptPubKey, $tx, $nIn, $flags, $error);
echo ($result == 1 ? "true" : "false") . PHP_EOL;
echo ($error === 0 ? "false" : "true") . PHP_EOL;
?>
--EXPECTF--
false
false
