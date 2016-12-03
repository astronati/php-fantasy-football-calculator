<?php

use \FFC\Calculator as Calculator;

class CalculatorTest extends PHPUnit_Framework_TestCase {

  public function goodProvider() {
    return array(
      array(
        array(
          array('id' => 1, 'vote' => 1, 'magicPoints' => 2),
          array('id' => 2, 'vote' => 2, 'magicPoints' => 3),
          array('id' => 3, 'vote' => 3, 'magicPoints' => 4),
          array('id' => 4, 'vote' => 4, 'magicPoints' => 5),
          array('id' => 5, 'vote' => 5, 'magicPoints' => 6),
          array('id' => 6, 'vote' => 6, 'magicPoints' => 7),
          array('id' => 7, 'vote' => 7, 'magicPoints' => 8),
        ),
        array(
          array('id' => 1, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 2, 'type' => 'R', 'order' => '3', 'role' => 'D'),
          array('id' => 3, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 4, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 5, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 6, 'type' => 'R', 'order' => '3', 'role' => 'C'),
          array('id' => 7, 'type' => 'T', 'order' => '3', 'role' => 'P'),
        ),
        72
      )
    );
  }

  public function defenseBonusProvider() {
    return array(
      array(
        array(
          array('id' => 1, 'vote' => 1, 'magicPoints' => 2),
          array('id' => 2, 'vote' => 2, 'magicPoints' => 3),
          array('id' => 3, 'vote' => 3, 'magicPoints' => 4),
          array('id' => 4, 'vote' => 4, 'magicPoints' => 5),
          array('id' => 5, 'vote' => 5, 'magicPoints' => 6),
          array('id' => 6, 'vote' => 6, 'magicPoints' => 7),
          array('id' => 7, 'vote' => 7, 'magicPoints' => 8),
        ),
        array(
          array('id' => 1, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 2, 'type' => 'R', 'order' => '3', 'role' => 'D'),
          array('id' => 3, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 4, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 5, 'type' => 'T', 'order' => '3', 'role' => 'D'),
          array('id' => 6, 'type' => 'R', 'order' => '3', 'role' => 'C'),
          array('id' => 7, 'type' => 'T', 'order' => '3', 'role' => 'P'),
        ),
        1,
      )
    );
  }

  private function _getQuotationFactoryMock(array $quotations = array()) {
    $quotationFactoryMock = $this->getMockBuilder('QuotationsFactory')
      ->setMethods(array('create'))
      ->getMock();

    $quotationsMocksMap = array();
    $quotationsMock = array();
    foreach ($quotations as $index => $quotation) {
      $quotationMock = $this->getMockBuilder('Quotation')
        ->disableOriginalConstructor()
        ->setMethods(array('getId'))
        ->getMock();

      $quotationMock->method('getId')->will($this->returnValue($quotation['id']));
      $quotationsMocksMap[$index] = array($quotation, $quotationMock);
      $quotationsMock[$index] = $quotationMock;
    }
    $quotationFactoryMock->method('create')->will($this->returnValueMap($quotationsMocksMap));

    return $quotationFactoryMock;
  }

  private function _getFormationFactoryMock(array $footballers = array()) {
    $formationFactoryMock = $this->getMockBuilder('FormationFactory')
      ->setMethods(array('create'))
      ->getMock();

    $formationMock = $this->getMockBuilder('Formation')
      ->disableOriginalConstructor()
      ->setMethods(array('getFirstStrings', 'getReserves', 'getGoalKeeperLabel', 'getDefenderLabel', 'getMidfielderLabel', 'getForwardLabel'))
      ->getMock();
    $formationMock->method('getGoalKeeperLabel')->will($this->returnValue('P'));
    $formationMock->method('getDefenderLabel')->will($this->returnValue('D'));
    $formationMock->method('getMidfielderLabel')->will($this->returnValue('C'));
    $formationMock->method('getForwardLabel')->will($this->returnValue('A'));

    $firstStrings = array();
    $reserves = array();
    foreach ($footballers as $footballer) {
      if ($footballer['type'] == "T") {
        array_push($firstStrings, $footballer);
      }
      if ($footballer['type'] == "R") {
        array_push($reserves, $footballer);
      }
    }
    $formationMock->method('getFirstStrings')->will($this->returnValue($firstStrings));
    $formationMock->method('getReserves')->will($this->returnValue($reserves));

    $formationFactoryMock->method('create')->will($this->returnValue($formationMock));

    return $formationFactoryMock;
  }

  private function _getConversionTableMock() {
    $conversionTableMock = $this->getMockBuilder('ConversionTable')->setMethods(array('getDefenseBonus'))->getMock();
    $defenseBonusMap = array(
      array($this->greaterThan(6.99), 6),
      array($this->greaterThan(6.49), 3),
      array(6,1),
      array($this->greaterThan(5.99), 1),
      array(3.75, 0),
      array($this->greaterThan(0), 0),
    );
    $conversionTableMock->method('getDefenseBonus')->will($this->returnValueMap($defenseBonusMap));

    return $conversionTableMock;
  }

  private function _getReportCardMock() {
    $reportCardMock = $this->getMockBuilder('ReportCard')->setMethods(array('getVotes'))->getMock();
    // TODO should pass value map as argument
    $reportCardMock->method('getVotes')->will($this->returnValue(array(6,6,6)));

    return $reportCardMock;
  }

  /**
   * @dataProvider goodProvider
   * @param array $quotations
   * @param array $footballers
   */
  public function testConstructMethod($quotations, $footballers) {
    $quotationFactoryMock = $this->_getQuotationFactoryMock($quotations);
    $formationFactoryMock = $this->_getFormationFactoryMock($footballers);

    $conversionTableMock = $this->_getConversionTableMock();
    $reportCard = $this->_getReportCardMock();

    new Calculator($quotations, array(), $formationFactoryMock, $quotationFactoryMock, $conversionTableMock, $reportCard);
  }

  /**
   * @dataProvider goodProvider
   * @param array $quotations
   * @param array $footballers
   * @param integer $result
   */
  public function testGetSumMethod($quotations, $footballers, $result) {
    $quotationFactoryMock = $this->_getQuotationFactoryMock($quotations);
    $formationFactoryMock = $this->_getFormationFactoryMock($footballers);

    $conversionTableMock = $this->_getConversionTableMock();
    $reportCard = $this->_getReportCardMock();

    $calculator = new Calculator($quotations, array(), $formationFactoryMock, $quotationFactoryMock, $conversionTableMock, $reportCard);
    $this->assertSame($result, $calculator->getSum($footballers));
  }

  /**
   * @dataProvider defenseBonusProvider
   * @param array $quotations
   * @param array $footballers
   * @param array $result
   */
  public function testGetDefenseBonusMethod($quotations, $footballers, $result) {
    $quotationFactoryMock = $this->_getQuotationFactoryMock($quotations);
    $formationFactoryMock = $this->_getFormationFactoryMock($footballers);

    $conversionTableMock = $this->_getConversionTableMock();
    $reportCard = $this->_getReportCardMock();

    $calculator = new Calculator($quotations, array('defenseBonus' => true), $formationFactoryMock, $quotationFactoryMock, $conversionTableMock, $reportCard);
    $this->assertSame($result, $calculator->getDefenseBonus($footballers));
  }

  // TODO missing test
  public function testGetFormationDetailsMethod() {}
}
