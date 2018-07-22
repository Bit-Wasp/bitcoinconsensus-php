--TEST--
bitcoinconsensus_err amount required

--SKIPIF--
<?php
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
if (!defined("BITCOINCONSENSUS_ERR_AMOUNT_REQUIRED")) print "skip BITCOINCONSENSUS_ERR_AMOUNT_REQUIRED not defined";
?>
--FILE--
<?php
echo BITCOINCONSENSUS_ERR_AMOUNT_REQUIRED . PHP_EOL;
?>
--EXPECTF--
4
