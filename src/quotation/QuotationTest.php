<?php

use \FFC\Quotation as Quotation;

/**
 * @codeCoverageIgnore
 */
class QuotationTest extends PHPUnit_Framework_TestCase {

    public function badConfigProvider() {
        return [
            [
                // Config
                ['']
            ],
            [
                ['magicPoints' => 1]
            ],
            [
                ['magicPoints' => 1, 'magicPoints' => 1]
            ],
            [
                ['magicPoints' => 1, 'vote' => 1]
            ],
            [
                ['autoGoal' => 1, 'vote' => 1]
            ],
            [
                ['assist' => 1, 'vote' => 1]
            ],
            [
                ['caution' => 1, 'goal' => 1]
            ],
            [
                ['magicPoints' => 1, 'goal' => 1]
            ],
            [
                ['penalty' => 1, 'goal' => 1]
            ],
        ];
    }

    public function goodConfigProvider() {
        return [
            [
                // Config
                [
                    'footballerID' => '1',
                    'magicPoints' => '2',
                    'vote' => '3',
                    'test' => 'gas',
                    'goal' => 3,
                    'caution' => 0.5,
                    'expulsion' => 1,
                    'penalty' => 3,
                    'autoGoal' => -2,
                    'assist' => 2,
                ],
                // Result
                [
                    'footballerID' => 1,
                    'magicPoints' => 2.0,
                    'vote' => 3.0,
                    'goal' => 3,
                    'caution' => 0.5,
                    'expulsion' => 1,
                    'penalty' => 3,
                    'autoGoal' => -2,
                    'assist' => 2,
                ],
            ],
        ];
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
    public function testGetFootballerIdMethod($config, $result) {
        $quotation = new Quotation($config);
        $this->assertSame($result['footballerID'], $quotation->getFootballerId());
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
    public function testGetGoalMethod($config, $result) {
        $quotation = new Quotation($config);
        $this->assertSame($result['goal'], $quotation->getGoal());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testGetCautionMethod($config, $result) {
        $quotation = new Quotation($config);
        $this->assertSame($result['caution'], $quotation->getCaution());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testGetExpulsionMethod($config, $result) {
        $quotation = new Quotation($config);
        $this->assertSame($result['expulsion'], $quotation->getExpulsion());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testGetPenaltyMethod($config, $result) {
        $quotation = new Quotation($config);
        $this->assertSame($result['penalty'], $quotation->getPenalty());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testGetAutoGoalMethod($config, $result) {
        $quotation = new Quotation($config);
        $this->assertSame($result['autoGoal'], $quotation->getAutoGoal());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testGetAssistMethod($config, $result) {
        $quotation = new Quotation($config);
        $this->assertSame($result['assist'], $quotation->getAssist());
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
