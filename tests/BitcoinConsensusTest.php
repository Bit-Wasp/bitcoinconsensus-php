<?php

namespace BitWasp\BitcoinConsensus\Tests;

class BitcoinConsensusTest extends \PHPUnit_Framework_TestCase
{
    public function testVersion()
    {
        $this->assertEquals(0, bitcoinconsensus_version());
    }
}