<?php

use \FFC\Formation as Formation;

class FormationTest extends PHPUnit_Framework_TestCase {

  /**
   * @var Array
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
  );

  public function goodFirstStringsProvider() {
    return array(
      array(
        $this->_footballers,
        'D',
        array(
          array('id' => 1, 'type' => 'T', 'order' => '1', 'role' => 'D'),
          array('id' => 2, 'type' => 'T', 'order' => '1', 'role' => 'D'),
          array('id' => 4, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 6, 'type' => 'T', 'order' => '2', 'role' => 'C'),
          array('id' => 9, 'type' => 'T', 'order' => '2', 'role' => 'A'),
          array('id' => 10, 'type' => 'T', 'order' => '3', 'role' => 'A'),
        ),
        array(
          array('id' => 2, 'type' => 'T', 'order' => '1', 'role' => 'D'),
          array('id' => 4, 'type' => 'T', 'order' => '3', 'role' => 'D'),
        )
      )
    );
  }

  public function goodReservesProvider() {
    return array(
      array(
        $this->_footballers,
        'D',
        array(
          array('id' => 3, 'type' => 'R', 'order' => '2', 'role' => 'D'),
          array('id' => 5, 'type' => 'R', 'order' => '1', 'role' => 'C'),
          array('id' => 7, 'type' => 'R', 'order' => '3', 'role' => 'C'),
          array('id' => 8, 'type' => 'R', 'order' => '1', 'role' => 'A'),
        ),
        array(
          array('id' => 3, 'type' => 'R', 'order' => '2', 'role' => 'D'),
        )
      )
    );
  }

  /**
   * @dataProvider goodFirstStringsProvider
   * @param Array $footballers
   */
  public function testConstructMethod($footballers) {
    $formation = new Formation($footballers);
    $this->assertNotNull($formation);
  }

  /**
   * @dataProvider goodFirstStringsProvider
   * @param Array $footballers
   * @param string $role
   * @param Array $firstStrings
   * @param Array $firstStringsByRole
   */
  public function testGetFirstStringsMethod($footballers, $role, $firstStrings, $firstStringsByRole) {
    $footballerMocks = array();

    foreach ($footballers as $index => $footballer) {
      $footballerMock = $this->getMockBuilder('Footballer')
        ->disableOriginalConstructor()
        ->setMethods(array('isFirstString', 'isReserve', 'getRole'))
        ->getMock();

      $footballerMock->method('isFirstString')->will($this->returnValue($footballer['type'] === 'T'));
      $footballerMock->method('isReserve')->will($this->returnValue($footballer['type'] === 'R'));
      $footballerMock->method('getRole')->will($this->returnValue($footballer['role']));

      array_push($footballerMocks, $footballerMock);
    }

    $formation = new Formation($footballerMocks);
    $formationFS = $formation->getFirstStrings();
    foreach ($firstStrings as $index => $firstString) {
      $this->assertSame(true, $formationFS[$index]->isFirstString());
    }

    $formationFSBR = $formation->getFirstStrings($role);
    foreach ($firstStringsByRole as $index => $firstString) {
      $this->assertSame(true, $formationFSBR[$index]->isFirstString());
      $this->assertSame($role, $formationFSBR[$index]->getRole());
    }
  }

  /**
   * @dataProvider goodReservesProvider
   * @param Array $footballers
   * @param string $role
   * @param Array $reserves
   * @param Array $reservesByRole
   */
  public function testGetReservesMethod($footballers, $role, $reserves, $reservesByRole) {
    $footballerMocks = array();

    foreach ($footballers as $index => $footballer) {
      $footballerMock = $this->getMockBuilder('Footballer')
        ->disableOriginalConstructor()
        ->setMethods(array('isFirstString', 'isReserve', 'getRole'))
        ->getMock();

      $footballerMock->method('isFirstString')->will($this->returnValue($footballer['type'] === 'T'));
      $footballerMock->method('isReserve')->will($this->returnValue($footballer['type'] === 'R'));
      $footballerMock->method('getRole')->will($this->returnValue($footballer['role']));

      array_push($footballerMocks, $footballerMock);
    }

    $formation = new Formation($footballerMocks);
    $formationFS = $formation->getReserves();
    foreach ($reserves as $index => $reserve) {
      $this->assertSame(true, $formationFS[$index]->isReserve());
    }

    $formationFSBR = $formation->getReserves($role);
    foreach ($reservesByRole as $index => $reserve) {
      $this->assertSame(true, $formationFSBR[$index]->isReserve());
      $this->assertSame($role, $formationFSBR[$index]->getRole());
    }
  }

  public function testGetGoalKeeperLabelMethod() {
    $formation = new Formation(array());
    $this->assertSame('P', $formation->getGoalKeeperLabel());
  }

  public function testGetDefenderLabelMethod() {
    $formation = new Formation(array());
    $this->assertSame('D', $formation->getDefenderLabel());
  }

  public function testGetMidfielderLabelMethod() {
    $formation = new Formation(array());
    $this->assertSame('C', $formation->getMidfielderLabel());
  }

  public function testGetForwardLabelMethod() {
    $formation = new Formation(array());
    $this->assertSame('A', $formation->getForwardLabel());
  }
}
