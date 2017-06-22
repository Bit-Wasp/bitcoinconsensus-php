<?php

namespace BitWasp\BitcoinConsensus\Tests;

class BitcoinConsensusTest extends \PHPUnit_Framework_TestCase
{
    public function testNullDummy()
    {
        $nullDummyBit = 1 << 4;
        $expectFindInALL = false;
        if (defined('BITCOINCONSENSUS_VERIFY_NULLDUMMY')) {
            $expectFindInALL = true;

            $this->assertEquals($nullDummyBit, BITCOINCONSENSUS_VERIFY_NULLDUMMY);
            $this->assertEquals($nullDummyBit, BITCOINCONSENSUS_VERIFY_ALL & (BITCOINCONSENSUS_VERIFY_NULLDUMMY));
        }

        $this->assertEquals($expectFindInALL, (BITCOINCONSENSUS_VERIFY_ALL & ($nullDummyBit)) != 0);
    }

    public function testFlagsAll()
    {
        $expectFlags =
            BITCOINCONSENSUS_VERIFY_NONE |
            BITCOINCONSENSUS_VERIFY_P2SH |
            BITCOINCONSENSUS_VERIFY_DERSIG |
            BITCOINCONSENSUS_VERIFY_CHECKLOCKTIMEVERIFY |
            BITCOINCONSENSUS_VERIFY_CHECKSEQUENCEVERIFY |
            BITCOINCONSENSUS_VERIFY_WITNESS;

        if (defined('BITCOINCONSENSUS_VERIFY_NULLDUMMY')) {
            $expectFlags = $expectFlags | BITCOINCONSENSUS_VERIFY_NULLDUMMY;
        }

        $this->assertEquals($expectFlags, BITCOINCONSENSUS_VERIFY_ALL);
    }

    public function testVersion()
    {
        $this->assertEquals(1, bitcoinconsensus_version());
    }

    public function getSignerScriptTests()
    {
        $vectors = json_decode(file_get_contents(__DIR__ . '/signer-fixtures.json') , true);
        $results = array();
        foreach ($vectors['valid'] as $vector) {
            if (array_key_exists('whex', $vector) && $vector['whex'] != "") {
                $tx = $vector['whex'];
            } else {
                $tx = $vector['hex'];
            }

            foreach ($vector['raw']['ins'] as $nIn => $input) {
                $results[] = array(
                    $input['scriptPubKey'], $input['value'], $tx, $nIn, BITCOINCONSENSUS_VERIFY_ALL, true, $vector
                );
            }
        }

        return $results;
    }

    public function getBitcoinScriptTests()
    {
        $vectors = json_decode(file_get_contents(__DIR__ . '/data.json') , true);
        $results = array();
        foreach ($vectors as $vector) {
            if ($vector['flags'] == ($vector['flags']&BITCOINCONSENSUS_VERIFY_ALL)) {
                $results[] = array(
                    $vector['scriptPubKey'], $vector['amount'], $vector['tx'], $vector['nIn'], $vector['flags'], $vector['result'], $vector
                );
            }
        }
        return $results;
    }

    public function getScriptFixtures()
    {
        $vectors = array();
        foreach (array('getSignerScriptTests', 'getBitcoinScriptTests') as $fxn) {
            $vectors = array_merge($vectors, $this->{$fxn}());
        }
        return $vectors;
    }

    /**
     * @param bool $eResult
     * @param string $scriptHex
     * @param string $txHex
     * @param int $nInput
     * @param int $flags
     * @dataProvider getScriptFixtures
     */
    public function testValidOk($scriptHex, $amount, $txHex, $nInput, $flags, $eResult, $d = array())
    {
        $script = pack("H*", $scriptHex);
        $tx = pack("H*", $txHex);

        $error = 0;

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
