--TEST--
Code coverage for PHP_MINFO_FUNCTION(bitcoinconsensus)
--SKIPIF--
<?php
if (!extension_loaded("bitcoinconsensus")) print "skip extension not loaded";
?>
--FILE--
<?php
ob_start();
phpinfo(INFO_MODULES);
$v = ob_get_clean();
$r = preg_match('/bitcoinconsensus support .* enabled/', $v);
if ($r !== 1)
    var_dump($r);
echo "Done\n";
?>
--EXPECTF--
Done
