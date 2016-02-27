<?php

class ReportCardTest extends PHPUnit_Framework_TestCase {

  public function dataProvider() {
    return array(
      array(
        array(
          array('getVote' => 5, 'getMagicPoints' => 6),
          array('getVote' => 6, 'getMagicPoints' => 7),
          array('getVote' => 7, 'getMagicPoints' => 8),
          array('getVote' => 8, 'getMagicPoints' => 9),
        ),
        array(
          array('getVote' => 4, 'getMagicPoints' => 5),
          array('getVote' => 3, 'getMagicPoints' => 4),
        ),
        true,
        array(6,7,8,9)
      ),
      array(
        array(
          array('getVote' => 5, 'getMagicPoints' => 6),
          array('getVote' => 6, 'getMagicPoints' => 7),
          array('getVote' => 7, 'getMagicPoints' => 8),
          array('getVote' => 8, 'getMagicPoints' => 9),
        ),
        array(
          array('getVote' => 4, 'getMagicPoints' => 5),
          array('getVote' => 3, 'getMagicPoints' => 4),
        ),
        false,
        array(5,6,7,8)
      ),
      array(
        array(
          array('getVote' => 5, 'getMagicPoints' => 6),
          array('getVote' => 6, 'getMagicPoints' => 7),
          array('getVote' => 7, 'getMagicPoints' => 8)
        ),
        array(
          array('getVote' => 4, 'getMagicPoints' => 5),
          array('getVote' => 3, 'getMagicPoints' => 4),
        ),
        false,
        array(5,6,7)
      ),
      array(
        array(
          array('getVote' => 5, 'getMagicPoints' => 6),
          array('getVote' => 6, 'getMagicPoints' => 7),
          array('getVote' => 7, 'getMagicPoints' => 8)
        ),
        array(
          array('getVote' => 4, 'getMagicPoints' => 5),
          array('getVote' => 3, 'getMagicPoints' => 4),
        ),
        true,
        array(6,7,8)
      ),
      array(
        array(
          array('getVote' => 0, 'getMagicPoints' => 0),
          array('getVote' => 6, 'getMagicPoints' => 6.5),
          array('getVote' => 7, 'getMagicPoints' => 7)
        ),
        array(
          array('getVote' => 4, 'getMagicPoints' => 5),
          array('getVote' => 3, 'getMagicPoints' => 4),
        ),
        true,
        array(5,6.5,7)
      ),
      array(
        array(
          array('getVote' => 5, 'getMagicPoints' => 0),
          array('getVote' => 6, 'getMagicPoints' => 6.5),
          array('getVote' => 7, 'getMagicPoints' => 7)
        ),
        array(
          array('getVote' => 4, 'getMagicPoints' => 5),
          array('getVote' => 3, 'getMagicPoints' => 4),
        ),
        true,
        array(0,6.5,7)
      ),
      array(
        array(
          array('getVote' => 5, 'getMagicPoints' => 0),
          array('getVote' => 6, 'getMagicPoints' => 6.5),
          array('getVote' => 7, 'getMagicPoints' => 7)
        ),
        array(
          array('getVote' => 4, 'getMagicPoints' => 5),
          array('getVote' => 3, 'getMagicPoints' => 4),
        ),
        false,
        array(5,6,7)
      ),
    );
  }

  /**
   * @dataProvider dataProvider
   * @param Formation $formation
   * @param string $role
   * @param boolean $useMagicPoints
   * @param Array $result
   */
  public function testGetVotesMethod($firstStrings, $reserves, $useMagicPoints, $result) {
    $formationMock = $this->getMockBuilder('Formation')
      ->disableOriginalConstructor()
      ->setMethods(array('getFirstStrings', 'getReserves'))
      ->getMock();

    $firstStringsArray = array();
    foreach ($firstStrings as $quotation) {
      $quotationMock = $this->getMockBuilder('Quotation')
        ->disableOriginalConstructor()
        ->setMethods(array('getVote', 'getMagicPoints'))
        ->getMock();
      $quotationMock->method('getVote')->will($this->returnValue($quotation['getVote']));
      $quotationMock->method('getMagicPoints')->will($this->returnValue($quotation['getMagicPoints']));
      array_push($firstStringsArray, $quotationMock);
    }

    $reservesArray = array();
    foreach ($reserves as $quotation) {
      $quotationMock = $this->getMockBuilder('Quotation')
        ->disableOriginalConstructor()
        ->setMethods(array('getVote', 'getMagicPoints'))
        ->getMock();
      $quotationMock->method('getVote')->will($this->returnValue($quotation['getVote']));
      $quotationMock->method('getMagicPoints')->will($this->returnValue($quotation['getMagicPoints']));
      array_push($reservesArray, $quotationMock);
    }

    $formationMock->method('getFirstStrings')->will($this->returnValue($firstStringsArray));
    $formationMock->method('getReserves')->will($this->returnValue($reservesArray));

    $reportCard = ReportCard::getInstance();
    $this->assertSame($result, $reportCard->getVotes($formationMock, '', $useMagicPoints));
  }
}
