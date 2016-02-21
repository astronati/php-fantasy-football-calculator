<?php

class FormationTest extends PHPUnit_Framework_TestCase {

  public function badConfigProvider() {
    return array(
      array(
        array(
          array(1),
          array(2),
          array(3),
          array(4),
        )
      )
    );
  }

  public function goodConfigProvider() {
    return array(
      array(
        array(
          array('id' => 1, 'type' => 'T', 'order' => '1', 'role' => 'D'),
          array('id' => 2, 'type' => 'R', 'order' => '1', 'role' => 'D'),
          array('id' => 3, 'type' => 'R', 'order' => '1', 'role' => 'A'),
          array('id' => 4, 'type' => 'T', 'order' => '1', 'role' => 'P'),
        )
      )
    );
  }

  /**
   * @expectedException Exception
   * @expectedExceptionMessage Missing parameter
   * @dataProvider badConfigProvider
   * @param Array $config
   */
  public function testBadConstructMethod($config) {
    $formation = new Formation($config);
  }

  /**
   * @dataProvider goodConfigProvider
   * @param Array $config
   */
  public function testGoodConstructMethod($config) {
    $formation = new Formation($config);
    $this->assertNotNull($formation);
  }

  /**
   * @dataProvider goodConfigProvider
   * @param Array $config
   * @param Array $result
   *
  public function testGetFirstStringsMethod($config) {
    $footballer = $this->getMockBuilder('Footballer')->disableOriginalConstructor()->getMock();
    $formation = new Formation($config);
    $this->assertSame(array($footballer), $formation->getFirstStrings());
  }*/
}
