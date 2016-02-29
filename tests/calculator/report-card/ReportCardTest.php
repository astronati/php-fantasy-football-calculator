<?php

use \FFC\ReportCard as ReportCard;

class ReportCardTest extends PHPUnit_Framework_TestCase {

  public function dataProvider() {
    return array(
      array(
        array(
          array('id' => 1, 'vote' => 5, 'magicPoints' => 6),
          array('id' => 2, 'vote' => 6, 'magicPoints' => 7),
          array('id' => 3, 'vote' => 7, 'magicPoints' => 8),
          array('id' => 4, 'vote' => 8, 'magicPoints' => 9),
        ),
        array(
          array('id' => 5, 'vote' => 4, 'magicPoints' => 5),
          array('id' => 6, 'vote' => 3, 'magicPoints' => 4),
        ),
        true,
        array(6,7,8,9)
      ),
      array(
        array(
          array('id' => 1, 'vote' => 5, 'magicPoints' => 6),
          array('id' => 2, 'vote' => 6, 'magicPoints' => 7),
          array('id' => 3, 'vote' => 7, 'magicPoints' => 8),
          array('id' => 4, 'vote' => 8, 'magicPoints' => 9),
        ),
        array(
          array('id' => 5, 'vote' => 4, 'magicPoints' => 5),
          array('id' => 6, 'vote' => 3, 'magicPoints' => 4),
        ),
        false,
        array(5,6,7,8)
      ),
      array(
        array(
          array('id' => 1, 'vote' => 5, 'magicPoints' => 6),
          array('id' => 2, 'vote' => 6, 'magicPoints' => 7),
          array('id' => 3, 'vote' => 7, 'magicPoints' => 8)
        ),
        array(
          array('id' => 4, 'vote' => 4, 'magicPoints' => 5),
          array('id' => 5, 'vote' => 3, 'magicPoints' => 4),
        ),
        false,
        array(5,6,7)
      ),
      array(
        array(
          array('id' => 1, 'vote' => 5, 'magicPoints' => 6),
          array('id' => 2, 'vote' => 6, 'magicPoints' => 7),
          array('id' => 3, 'vote' => 7, 'magicPoints' => 8)
        ),
        array(
          array('id' => 4, 'vote' => 4, 'magicPoints' => 5),
          array('id' => 5, 'vote' => 3, 'magicPoints' => 4),
        ),
        true,
        array(6,7,8)
      ),
      array(
        array(
          array('id' => 1, 'vote' => 0, 'magicPoints' => 0),
          array('id' => 2, 'vote' => 6, 'magicPoints' => 6.5),
          array('id' => 3, 'vote' => 7, 'magicPoints' => 7)
        ),
        array(
          array('id' => 4, 'vote' => 4, 'magicPoints' => 5),
          array('id' => 5, 'vote' => 3, 'magicPoints' => 4),
        ),
        true,
        array(5,6.5,7)
      ),
      array(
        array(
          array('id' => 1, 'vote' => 5, 'magicPoints' => 0),
          array('id' => 2, 'vote' => 6, 'magicPoints' => 6.5),
          array('id' => 3, 'vote' => 7, 'magicPoints' => 7)
        ),
        array(
          array('id' => 4, 'vote' => 4, 'magicPoints' => 5),
          array('id' => 5, 'vote' => 3, 'magicPoints' => 4),
        ),
        true,
        array(0,6.5,7)
      ),
      array(
        array(
          array('id' => 1, 'vote' => 5, 'magicPoints' => 0),
          array('id' => 2, 'vote' => 6, 'magicPoints' => 6.5),
          array('id' => 3, 'vote' => 7, 'magicPoints' => 7)
        ),
        array(
          array('id' => 4, 'vote' => 4, 'magicPoints' => 5),
          array('id' => 5, 'vote' => 3, 'magicPoints' => 4),
        ),
        false,
        array(5,6,7)
      ),
    );
  }

  /**
   * @dataProvider dataProvider
   * @param Array $firstStrings
   * @param Array $reserves
   * @param boolean $useMagicPoints
   * @param Array $result
   */
  public function testGetVotesMethod($firstStringsQuotations, $reservesQuotations, $useMagicPoints, $result) {
    $formationMock = $this->getMockBuilder('Formation')
      ->disableOriginalConstructor()
      ->setMethods(array('getFirstStrings', 'getReserves'))
      ->getMock();

    $quotations = array();

    $firstStrings = array();
    foreach ($firstStringsQuotations as $quotation) {
      $quotationMock = $this->getMockBuilder('Quotation')
        ->disableOriginalConstructor()
        ->setMethods(array('getId', 'getVote', 'getMagicPoints'))
        ->getMock();
      $quotationMock->method('getId')->will($this->returnValue($quotation['id']));
      $quotationMock->method('getVote')->will($this->returnValue($quotation['vote']));
      $quotationMock->method('getMagicPoints')->will($this->returnValue($quotation['magicPoints']));

      $quotations[$quotation['id']] = $quotationMock;
      array_push($firstStrings, $quotationMock);
    }

    $reserves = array();
    foreach ($reservesQuotations as $quotation) {
      $quotationMock = $this->getMockBuilder('Quotation')
        ->disableOriginalConstructor()
        ->setMethods(array('getId', 'getVote', 'getMagicPoints'))
        ->getMock();
      $quotationMock->method('getId')->will($this->returnValue($quotation['id']));
      $quotationMock->method('getVote')->will($this->returnValue($quotation['vote']));
      $quotationMock->method('getMagicPoints')->will($this->returnValue($quotation['magicPoints']));

      $quotations[$quotation['id']] = $quotationMock;
      array_push($reserves, $quotationMock);
    }

    $formationMock->method('getFirstStrings')->will($this->returnValue($firstStrings));
    $formationMock->method('getReserves')->will($this->returnValue($reserves));

    $reportCard = ReportCard::getInstance();
    $this->assertSame($result, $reportCard->getVotes($formationMock, $quotations, '', $useMagicPoints));
  }
}
