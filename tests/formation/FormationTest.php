<?php

class FormationTest extends PHPUnit_Framework_TestCase {

  public function goodConfigProvider() {
    return array(
      array(
        array(
          array('id' => 1, 'type' => 'T', 'order' => '1', 'role' => 'D'),
          array('id' => 2, 'type' => 'R', 'order' => '1', 'role' => 'D'),
          array('id' => 3, 'type' => 'R', 'order' => '1', 'role' => 'A'),
          array('id' => 4, 'type' => 'T', 'order' => '1', 'role' => 'P'),
        ),
        // TODO Should I add a reference to indicate which rule and result I should attend
      )
    );
  }

  /**
   * @dataProvider goodConfigProvider
   * @param Array $config
   */
  public function testConstructMethod($config) {
    $formation = new Formation($config);
    $this->assertNotNull($formation);
  }

  /**
   * @dataProvider goodConfigProvider
   * @param Array $config
   */
  public function testGetFirstStringsMethod($config) {
    $role = 'D';
    $footballerMocks = array();
    $firstStrings = array();
    $firstStringsByRole = array();

    foreach ($config as $index => $footballer) {
      $footballerMock = $this->getMockBuilder('Footballer')
        ->disableOriginalConstructor()
        ->setMethods(array('isFirstString', 'isReserve', 'getRole'))
        ->getMock();

      $footballerMock->method('isFirstString')->will($this->returnValue($footballer['type'] === 'T'));
      $footballerMock->method('isReserve')->will($this->returnValue($footballer['type'] === 'R'));
      $footballerMock->method('isReserve')->will($this->returnValue($footballer['role']));

      array_push($footballerMocks, $footballerMock);

      if ($footballerMock->isFirstString()) {
        array_push($firstStrings, $footballerMock);
      }

      if ($footballerMock->getRole() == $role) {
        array_push($firstStringsByRole, $footballerMock);
      }
    }

    $formation = new Formation($footballerMocks);
    $this->assertSame($firstStrings, $formation->getFirstStrings());
    $this->assertSame($firstStringsByRole, $formation->getFirstStrings($role));
  }

  /**
   * @dataProvider goodConfigProvider
   * @param Array $config
   */
  public function testGetReservesMethod($config) {
    $role = 'D';
    $footballerMocks = array();
    $reserves = array();
    $reservesByRole = array();

    foreach ($config as $index => $footballer) {
      $footballerMock = $this->getMockBuilder('Footballer')
          ->disableOriginalConstructor()
          ->setMethods(array('isFirstString', 'isReserve', 'getRole'))
          ->getMock();

      $footballerMock->method('isFirstString')->will($this->returnValue($footballer['type'] === 'T'));
      $footballerMock->method('isReserve')->will($this->returnValue($footballer['type'] === 'R'));
      $footballerMock->method('isReserve')->will($this->returnValue($footballer['role']));

      array_push($footballerMocks, $footballerMock);

      if ($footballerMock->isReserve()) {
        array_push($reserves, $footballerMock);
      }

      if ($footballerMock->getRole() == $role) {
        array_push($reservesByRole, $footballerMock);
      }
    }

    $formation = new Formation($footballerMocks);
    $this->assertSame($reserves, $formation->getReserves());
    $this->assertSame($reservesByRole, $formation->getReserves($role));
  }
}
