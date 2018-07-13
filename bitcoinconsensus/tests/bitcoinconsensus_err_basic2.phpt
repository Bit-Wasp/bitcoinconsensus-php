--TEST--
bitcoinconsensus_err types

--SKIPIF--
<?php
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
if (!defined("BITCOINCONSENSUS_ERR_INVALID_FLAGS")) print "skip extension not loaded";
?>
--FILE--
<?php
echo BITCOINCONSENSUS_ERR_INVALID_FLAGS . PHP_EOL;
?>
--EXPECTF--
5
