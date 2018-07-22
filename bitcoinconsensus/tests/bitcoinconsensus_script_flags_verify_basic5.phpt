--TEST--
bitcoinconsensus script flag BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_WITNESS
--SKIPIF--
<?php 
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
if (!defined("BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_WITNESS")) print "skip BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_WITNESS not defined";
?>
--FILE--
<?php
echo BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_WITNESS . PHP_EOL;
?>
--EXPECTF--
2048

