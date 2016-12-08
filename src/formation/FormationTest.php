<?php

use \FFC\Formation as Formation;

/**
 * @codeCoverageIgnore
 */
class FormationTest extends PHPUnit_Framework_TestCase {

    /**
     * @var array
     */
    private $_footballers = array(
        array('id' => 1, 'type' => 'T', 'order' => '1', 'role' => 'P'),
        array('id' => 2, 'type' => 'T', 'order' => '1', 'role' => 'D'),
        array('id' => 3, 'type' => 'R', 'order' => '2', 'role' => 'D'),
        array('id' => 4, 'type' => 'T', 'order' => '3', 'role' => 'D'),
        array('id' => 5, 'type' => 'R', 'order' => '1', 'role' => 'C'),
        array('id' => 6, 'type' => 'T', 'order' => '2', 'role' => 'C'),
        array('id' => 7, 'type' => 'R', 'order' => '3', 'role' => 'C'),
        array('id' => 8, 'type' => 'R', 'order' => '1', 'role' => 'A'),
        array('id' => 9, 'type' => 'T', 'order' => '2', 'role' => 'A'),
        array('id' => 10, 'type' => 'T', 'order' => '3', 'role' => 'A'),
        array('id' => 11, 'type' => 'R', 'order' => '4', 'role' => 'P'),
    );

    private function _createFootballersMock($footballers) {
        $footballerMocks = array();

        foreach ($footballers as $index => $footballer) {
            $footballerMock = $this->getMockBuilder('Footballer')
                ->disableOriginalConstructor()
                ->setMethods(array(
                    'getId',
                    'isFirstString',
                    'isReserve',
                    'isGoalkeeper',
                    'isDefender',
                    'isMidfielder',
                    'isForward',
                ))
                ->getMock();

            $footballerMock->method('getId')->will($this->returnValue($footballer['id']));
            $footballerMock->method('isFirstString')->will($this->returnValue($footballer['type'] === 'T'));
            $footballerMock->method('isReserve')->will($this->returnValue($footballer['type'] === 'R'));
            $footballerMock->method('isGoalkeeper')->will($this->returnValue($footballer['role'] === 'P'));
            $footballerMock->method('isDefender')->will($this->returnValue($footballer['role'] === 'D'));
            $footballerMock->method('isMidfielder')->will($this->returnValue($footballer['role'] === 'C'));
            $footballerMock->method('isForward')->will($this->returnValue($footballer['role'] === 'A'));

            array_push($footballerMocks, $footballerMock);
        }
        return $footballerMocks;
    }

    public function testConstructMethod() {
        $formation = new Formation($this->_createFootballersMock($this->_footballers));
        $this->assertNotNull($formation);
    }

    public function testGetFootballersMethod() {
        $formation = new Formation($this->_createFootballersMock($this->_footballers));
        $this->assertSame(11, count($formation->getFootballers()));
    }

    public function testFilterGoalkeeperMethod() {
        $formation = new Formation($this->_createFootballersMock($this->_footballers));
        $footballers = $formation->filterGoalkeepers()
            ->getFootballers();
        $this->assertSame(2, count($footballers));
        $this->assertSame(1, $footballers[0]->getId());
        $this->assertSame(11, $footballers[1]->getId());
    }

    public function testFilterGoalkeeperAsFirstString() {
        $formation = new Formation($this->_createFootballersMock($this->_footballers));
        $footballers = $formation->filterGoalkeepers()
            ->filterFirstStrings()
            ->getFootballers();
        $this->assertSame(1, count($footballers));
        $this->assertSame(1, $footballers[0]->getId());
    }

    public function testFilterDefenderMethod() {
        $formation = new Formation($this->_createFootballersMock($this->_footballers));
        $footballers = $formation->filterDefenders()
            ->getFootballers();
        $this->assertSame(3, count($footballers));
        $this->assertSame(2, $footballers[0]->getId());
        $this->assertSame(3, $footballers[1]->getId());
        $this->assertSame(4, $footballers[2]->getId());
    }

    public function testFilterMidfielderMethod() {
        $formation = new Formation($this->_createFootballersMock($this->_footballers));
        $footballers = $formation->filterMidfielders()
            ->getFootballers();
        $this->assertSame(3, count($footballers));
        $this->assertSame(5, $footballers[0]->getId());
        $this->assertSame(6, $footballers[1]->getId());
        $this->assertSame(7, $footballers[2]->getId());
    }

    public function testFilterForwardMethod() {
        $formation = new Formation($this->_createFootballersMock($this->_footballers));
        $footballers = $formation->filterForwards()
            ->getFootballers();
        $this->assertSame(3, count($footballers));
        $this->assertSame(8, $footballers[0]->getId());
        $this->assertSame(9, $footballers[1]->getId());
        $this->assertSame(10, $footballers[2]->getId());
    }

    public function testFilterFirstStringsMethod() {
        $formation = new Formation($this->_createFootballersMock($this->_footballers));
        $footballers = $formation->filterFirstStrings()
            ->getFootballers();
        $this->assertSame(6, count($footballers));
        $this->assertSame(1, $footballers[0]->getId());
        $this->assertSame(2, $footballers[1]->getId());
        $this->assertSame(4, $footballers[2]->getId());
    }

    public function testFilterReservesMethod() {
        $formation = new Formation($this->_createFootballersMock($this->_footballers));
        $footballers = $formation->filterReserves()
            ->getFootballers();
        $this->assertSame(5, count($footballers));
        $this->assertSame(3, $footballers[0]->getId());
        $this->assertSame(5, $footballers[1]->getId());
        $this->assertSame(7, $footballers[2]->getId());
    }
}