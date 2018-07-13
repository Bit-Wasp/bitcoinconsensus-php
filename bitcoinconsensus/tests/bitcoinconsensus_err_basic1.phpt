--TEST--
bitcoinconsensus_err types
--SKIPIF--
<?php if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded"; ?>
--FILE--
<?php
echo BITCOINCONSENSUS_ERR_OK . PHP_EOL;
echo BITCOINCONSENSUS_ERR_TX_INDEX . PHP_EOL;
echo BITCOINCONSENSUS_ERR_TX_SIZE_MISMATCH . PHP_EOL;
echo BITCOINCONSENSUS_ERR_TX_DESERIALIZE . PHP_EOL;
echo BITCOINCONSENSUS_ERR_AMOUNT_REQUIRED . PHP_EOL;
?>
--EXPECTF--
0
1
2
3
4
