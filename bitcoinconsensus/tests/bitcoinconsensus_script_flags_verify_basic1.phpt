--TEST--
bitcoinconsensus script flags verify basic
--SKIPIF--
<?php if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded"; ?>
--FILE--
<?php
echo BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_P2SH . PHP_EOL;
echo BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_DERSIG . PHP_EOL;
?>
--EXPECTF--
1
4
