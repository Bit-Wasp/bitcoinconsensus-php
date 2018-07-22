--TEST--
bitcoinconsensus script flag BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_NULLDUMMY
--SKIPIF--
<?php 
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
if (!defined("BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_NULLDUMMY")) print "skip BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_NULLDUMMY not defined";
?>
--FILE--
<?php
echo BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_NULLDUMMY . PHP_EOL;
?>
--EXPECTF--
16
