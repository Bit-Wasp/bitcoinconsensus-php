<?php

namespace BitWasp\BitcoinConsensus\Tests;

class BitcoinConsensusTest extends \PHPUnit_Framework_TestCase
{

    public function testVersion()
    {
        $this->assertEquals(1, bitcoinconsensus_version());
    }

    public function getBitcoinScriptTests()
    {
        $vectors = json_decode(file_get_contents(__DIR__ . '/data.json') , true);
        $results = array();
        foreach ($vectors as $vector) {
            $results[] = array(
                $vector['scriptPubKey'], $vector['amount'], $vector['tx'], $vector['nIn'], $vector['flags'], $vector['result']
            );
        }
        return $results;
    }

    /**
     * @param bool $eResult
     * @param string $scriptHex
     * @param string $txHex
     * @param int $nInput
     * @param int $flags
     * @dataProvider getBitcoinScriptTests
     */
    public function testValidOk($scriptHex, $amount, $txHex, $nInput, $flags, $eResult)
    {
        $script = pack("H*", $scriptHex);
        $tx = pack("H*", $txHex);

        $error = 0;

        if ($flags & BITCOINCONSENSUS_VERIFY_CLEANSTACK) {
            $flags |= BITCOINCONSENSUS_VERIFY_P2SH;
            $flags |= BITCOINCONSENSUS_VERIFY_WITNESS;
        }

        if ($flags & (BITCOINCONSENSUS_VERIFY_P2SH | BITCOINCONSENSUS_VERIFY_WITNESS)) {
            $result = (bool)\bitcoinconsensus_verify_script_with_amount($script, $amount, $tx, $nInput, $flags, $error);
        } else {
            $result = (bool) \bitcoinconsensus_verify_script($script, $tx, $nInput, $flags, $error);
        }

        $this->assertEquals($eResult, $result);
        if ($eResult == 1) {
            $this->assertEquals(0, $error);
        }
    }
}
