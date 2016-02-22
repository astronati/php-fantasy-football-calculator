<?php

class CalculatorTest extends PHPUnit_Framework_TestCase {

  public function goodConfigProvider() {
    return array(
      array(
        array(
          array('id' => 1, 'vote' => 1, 'magicPoints' => 1),
          array('id' => 2, 'vote' => 2, 'magicPoints' => 2),
          array('id' => 3, 'vote' => 3, 'magicPoints' => 3),
          array('id' => 4, 'vote' => 4, 'magicPoints' => 4),
          array('id' => 5, 'vote' => 5, 'magicPoints' => 5),
        ),
        array(
          array('getId' => 1),
          array('getId' => 2),
          array('getId' => 3),
          array('getId' => 4),
          array('getId' => 5),
        )
      // TODO Should I add a reference to indicate which rule and result I should attend
      )
    );
  }

  /**
   * @dataProvider goodConfigProvider
   * @param Array $config
   */
  public function testConstructMethod($config) {
    $formationFactoryMock = $this->getMockBuilder('FormationFactory')
        ->setMethods(array('create'))
        ->getMock();

    $quotationFactoryMock = $this->getMockBuilder('QuotationsFactory')
        ->setMethods(array('create'))
        ->getMock();

    // Prepare quotations mocks
    // TODO Value map quotations

    //$calculator = new Calculator($config, array(), $formationFactoryMock, $quotationFactoryMock);
  }

  public function testGetSumMethod() {

  }
}
