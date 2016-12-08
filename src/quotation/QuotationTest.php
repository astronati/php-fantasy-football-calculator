<?php

use \FFC\Quotation as Quotation;

/**
 * @codeCoverageIgnore
 */
class QuotationTest extends PHPUnit_Framework_TestCase {

    public function badConfigProvider() {
        return array(
            array(
                // Config
                array('')
            ),
            array(
                array('id' => 1)
            ),
            array(
                array('id' => 1, 'magicPoints' => 1)
            ),
            array(
                array('id' => 1, 'vote' => 1)
            ),
            array(
                array('magicPoints' => 1, 'vote' => 1)
            ),
        );
    }

    public function goodConfigProvider() {
        return array(
            array(
                // Config
                array('id' => '1', 'magicPoints' => '2', 'vote' => '3', 'test' => 'gas'),
                // Result
                array('id' => 1, 'magicPoints' => 2.0, 'vote' => 3.0),
            ),
            array(
                // Config
                array('id' => '1', 'magicPoints' => '', 'vote' => ''),
                // Result
                array('id' => 1, 'magicPoints' => null, 'vote' => null),
            ),
        );
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Missing parameter
     * @dataProvider badConfigProvider
     * @param array $config
     */
    public function testBadConstructMethod($config) {
        new Quotation($config);
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     */
    public function testGoodConstructMethod($config) {
        $quotation = new Quotation($config);
        $this->assertNotNull($quotation);
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testGetIdMethod($config, $result) {
        $quotation = new Quotation($config);
        $this->assertSame($result['id'], $quotation->getId());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testGetMagicPointsMethod($config, $result) {
        $quotation = new Quotation($config);
        $this->assertSame($result['magicPoints'], $quotation->getMagicPoints());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testGetVoteMethod($config, $result) {
        $quotation = new Quotation($config);
        $this->assertSame($result['vote'], $quotation->getVote());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testToArrayMethod($config, $result) {
        $quotation = new Quotation($config);
        $this->assertSame($result, $quotation->toArray());
    }
}
