<?php

use \FFC\Footballer as Footballer;

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
                array('id' => '1', 'type' => 'T', 'order' => '3', 'role' => 'C'),
                array('id' => 1, 'type' => 'T', 'order' => 3, 'role' => 'C', 'firstString' => true, 'reserve' => false),
            ),
            array(
                array('id' => '1', 'type' => 'R', 'order' => '3', 'role' => 'C'),
                array('id' => 1, 'type' => 'R', 'order' => 3, 'role' => 'C', 'firstString' => false, 'reserve' => true),
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
    public function testGetRoleMethod($config, $result) {
        $footballer = new Footballer($config);
        $this->assertSame($result['role'], $footballer->getRole());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testIsFirstStringMethod($config, $result) {
        $footballer = new Footballer($config);
        $this->assertSame($result['firstString'], $footballer->isFirstString());
    }

    /**
     * @dataProvider goodConfigProvider
     * @param array $config
     * @param array $result
     */
    public function testIsReserveMethod($config, $result) {
        $footballer = new Footballer($config);
        $this->assertSame($result['reserve'], $footballer->isReserve());
    }
}
