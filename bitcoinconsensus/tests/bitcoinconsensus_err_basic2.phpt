--TEST--
bitcoinconsensus_err invalid flags

--SKIPIF--
<?php
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
if (!defined("BITCOINCONSENSUS_ERR_INVALID_FLAGS")) print "skip BITCOINCONSENSUS_ERR_INVALID_FLAGS not defined";
?>
--FILE--
<?php
echo BITCOINCONSENSUS_ERR_INVALID_FLAGS . PHP_EOL;
?>
--EXPECTF--
5
