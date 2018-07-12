--TEST--
bitcoinconsensus_version returns the version
--SKIPIF--
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
--FILE--
<?php
echo bitcoinconsensus_version().PHP_EOL;
?>
--EXPECTF--
1