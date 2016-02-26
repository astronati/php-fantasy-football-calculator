<?php

class AnObj extends stdClass
{
  public function __call($closure, $args)
  {
    return call_user_func_array($this->{$closure}->bindTo($this),$args);
  }

  public function __toString()
  {
    return call_user_func($this->{"__toString"}->bindTo($this));
  }
}

class CalculatorTest extends PHPUnit_Framework_TestCase {

  public function goodConfigProvider() {
    $st1 = new AnObj();
    $st1->getId = function() {
      return 1;
    };
    $st2 = new AnObj();
    $st2->getId = function() {
      return 2;
    };
    $st3 = new AnObj();
    $st3->getId = function() {
      return 3;
    };
    $st4 = new AnObj();
    $st4->getId = function() {
      return 4;
    };
    $st5 = new AnObj();
    $st5->getId = function() {
      return 5;
    };

    $formationMock = new AnObj();
    $formationMock->getFirstStrings = function($type) {
      if ($type == 'D') {
        return array(1,2,3,4);
      }
      else return array();
    };

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
          $st1, $st2, $st3, $st4, $st5
        ),
        array(
          array('id' => 1, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 2, 'type' => 'R', 'order' => '3', 'role' => 'D'),
          array('id' => 3, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 4, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 5, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 6, 'type' => 'R', 'order' => '3', 'role' => 'P'),
          array('id' => 7, 'type' => 'T', 'order' => '3', 'role' => 'C'),
        ),
        $formationMock,
        true,
        0
      // TODO Should I add a reference to indicate which rule and result I should attend
      )
    );
  }

  /**
   * @dataProvider goodConfigProvider
   * @param Array $quotations
   */
  public function testConstructMethod($quotations, $quotationsObjects) {
    $formationFactoryMock = $this->getMockBuilder('FormationFactory')
        ->setMethods(array('create'))
        ->getMock();

    $quotationFactoryMock = $this->getMockBuilder('QuotationsFactory')
        ->setMethods(array('create'))
        ->getMock();

    $quotationFactoryMap = array();
    foreach($quotations as $index => $singleConfig) {
      array_push($quotationFactoryMap, array($singleConfig, $quotationsObjects[$index]));
    }

    $quotationFactoryMock->method('create')
        ->will($this->returnValueMap($quotationFactoryMap));

    $calculator = new Calculator($quotations, array(), $formationFactoryMock, $quotationFactoryMock);
  }

  public function testGetSumMethod() {}

  /**
   * @dataProvider goodConfigProvider
   * @param Array $quotations
   */
  public function testGetDefenseBonusMethod($quotations, $quotationsObjects, $footballers, $formationMock, $defenseBonus, $result) {
    $formationFactoryMock = $this->getMockBuilder('FormationFactory')
        ->setMethods(array('create'))
        ->getMock();
    $formationFactoryMock->method('create')->will($this->returnValue($formationMock));

    $quotationFactoryMock = $this->getMockBuilder('QuotationsFactory')
        ->setMethods(array('create'))
        ->getMock();

    $quotationFactoryMap = array();
    foreach($quotations as $index => $singleConfig) {
      array_push($quotationFactoryMap, array($singleConfig, $quotationsObjects[$index]));
    }

    $quotationFactoryMock->method('create')
        ->will($this->returnValueMap($quotationFactoryMap));

    $calculator = new Calculator($quotations, array('defenseBonus' => $defenseBonus), $formationFactoryMock, $quotationFactoryMock);
    //$this->assertSame($result, $calculator->getDefenseBonus($footballers));
  }

  public function testGetFormationDetailsMethod() {}
}
