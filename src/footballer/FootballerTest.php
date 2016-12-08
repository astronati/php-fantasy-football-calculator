<?php

use \FFC\Footballer as Footballer;

/**
 * @codeCoverageIgnore
 */
class FootballerTest extends PHPUnit_Framework_TestCase {

    public function badConfigProvider() {
        return array(
            array(array('')),
            array(array('id' => 1)),
            array(array('id' => 1, 'type' => 1)),
            array(array('id' => 1, 'type' => 1, 'order' => 1)),
            array(array('id' => 1, 'type' => 1, 'role' => 1)),
        );
    }

    public function goodConfigProvider() {
        return array(
            array(
                // Config
                array('id' => '1', 'type' => 'T', 'order' => '3', 'role' => 'C'),
                // Result
                array(
                    'id' => 1,
                    'type' => 'T',
                    'order' => 3,
                    'role' => 'C',
                    'isFirstString' => true,
                    'isReserve' => false,
                    'isGoalkeeper' => false,
                    'isDefender' => false,
                    'isMidfielder' => true,
                    'isForward' => false,
                ),
            ),
            array(
                array('id' => '1', 'type' => 'R', 'order' => '3', 'role' => 'C'),
                array(
                    'id' => 1,
                    'type' => 'R',
                    'order' => 3,
                    'role' => 'C',
                    'isFirstString' => false,
                    'isReserve' => true,
                    'isGoalkeeper' => false,
                    'isDefender' => false,
                    'isMidfielder' => true,
                    'isForward' => false,
                ),
            ),
            array(
                array('id' => '1', 'type' => 'R', 'order' => '3', 'role' => 'P'),
                array(
                    'id' => 1,
                    'type' => 'R',
                    'order' => 3,
                    'role' => 'P',
                    'isFirstString' => false,
                    'isReserve' => true,
                    'isGoalkeeper' => true,
                    'isDefender' => false,
                    'isMidfielder' => false,
                    'isForward' => false,
                ),
            ),
            array(
                array('id' => '1', 'type' => 'R', 'order' => '3', 'role' => 'D'),
                array(
                    'id' => 1,
                    'type' => 'R',
                    'order' => 3,
                    'role' => 'D',
                    'isFirstString' => false,
                    'isReserve' => true,
                    'isGoalkeeper' => false,
                    'isDefender' => true,
                    'isMidfielder' => false,
                    'isForward' => false,
                ),
            ),
            array(
                array('id' => '1', 'type' => 'R', 'order' => '3', 'role' => 'A'),
                array(
                    'id' => 1,
                    'type' => 'R',
                    'order' => 3,
                    'role' => 'D',
                    'isFirstString' => false,
                    'isReserve' => true,
                    'isGoalkeeper' => false,
                    'isDefender' => false,
                    'isMidfielder' => false,
                    'isForward' => true,
                ),
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
        new Footballer($config);
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     */
    public function testGoodConstructMethod($config) {
        $footballer = new Footballer($config);
        $this->assertNotNull($footballer);
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testGetIdMethod($config, $result) {
        $footballer = new Footballer($config);
        $this->assertSame($result['id'], $footballer->getId());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testIsFirstStringMethod($config, $result) {
        $footballer = new Footballer($config);
        $this->assertSame($result['isFirstString'], $footballer->isFirstString());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testIsReserveMethod($config, $result) {
        $footballer = new Footballer($config);
        $this->assertSame($result['isReserve'], $footballer->isReserve());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testIsGoalkeeper($config, $result) {
        $footballer = new Footballer($config);
        $this->assertSame($result['isGoalkeeper'], $footballer->isGoalkeeper());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testIsDefender($config, $result) {
        $footballer = new Footballer($config);
        $this->assertSame($result['isDefender'], $footballer->isDefender());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testIsMidfielder($config, $result) {
        $footballer = new Footballer($config);
        $this->assertSame($result['isMidfielder'], $footballer->isMidfielder());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testIsForward($config, $result) {
        $footballer = new Footballer($config);
        $this->assertSame($result['isForward'], $footballer->isForward());
    }
}
