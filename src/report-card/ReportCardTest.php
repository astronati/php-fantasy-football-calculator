<?php

use \FFC\ReportCard as ReportCard;

/**
 * @codeCoverageIgnore
 */
class ReportCardTest extends PHPUnit_Framework_TestCase {

    public function dataProvider() {
        return array(
            array(
                // First Strings Quotations
                array(
                    array('id' => 1, 'vote' => 5, 'magicPoints' => 6),
                    array('id' => 2, 'vote' => 6, 'magicPoints' => 7),
                    array('id' => 3, 'vote' => 7, 'magicPoints' => 8),
                    array('id' => 4, 'vote' => 8, 'magicPoints' => 9),
                ),
                // Reserves Quotations
                array(
                    array('id' => 5, 'vote' => 4, 'magicPoints' => 5),
                    array('id' => 6, 'vote' => 3, 'magicPoints' => 4),
                ),
                // Use magic points
                true,
                // Expected result
                array(6,7,8,9)
            ),
            array(
                array(
                    array('id' => 1, 'vote' => 5, 'magicPoints' => 6),
                    array('id' => 2, 'vote' => null, 'magicPoints' => 7),
                    array('id' => 3, 'vote' => 7, 'magicPoints' => 8),
                    array('id' => 4, 'vote' => 8, 'magicPoints' => 9),
                ),
                array(
                    array('id' => 5, 'vote' => null, 'magicPoints' => 5),
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
                    array('id' => 1, 'vote' => null, 'magicPoints' => null),
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
                    array('id' => 4, 'vote' => 4, 'magicPoints' => 6),
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
                    array('id' => 4, 'vote' => 4, 'magicPoints' => 6),
                    array('id' => 5, 'vote' => 3, 'magicPoints' => 4),
                ),
                false,
                array(5,6,7)
            ),
        );
    }

    private function _createFootballersMock($footballers) {
        $footballersMock = array();
        foreach ($footballers as $footballer) {
            $footballerMock = $this->getMockBuilder('Footballer')
                ->disableOriginalConstructor()
                ->setMethods(array(
                    'getId',
                ))
                ->getMock();
            $footballerMock->method('getId')->will($this->returnValue($footballer['id']));
            array_push($footballersMock, $footballerMock);
        }
        return $footballersMock;
    }

    private function _createQuotationMock($quotation) {
        $quotationMock = $this->getMockBuilder('Quotation')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'getVote',
                'getMagicPoints',
            ))
            ->getMock();
        $quotationMock->method('getVote')->will($this->returnValue($quotation['vote']));
        $quotationMock->method('getMagicPoints')->will($this->returnValue($quotation['magicPoints']));
        return $quotationMock;
    }

    private function _createQuotationsMock($firstStringsQuotations, $reserveQuotations) {
        $quotationsMock = array();

        foreach ($firstStringsQuotations as $quotation) {
            $quotationsMock[$quotation['id']] = $this->_createQuotationMock($quotation);
        }

        foreach ($reserveQuotations as $quotation) {
            $quotationsMock[$quotation['id']] = $this->_createQuotationMock($quotation);
        }

        return $quotationsMock;
    }

    /**
     * @dataProvider dataProvider
     * @param array $firstStringsQuotations
     * @param array $reservesQuotations
     * @param boolean $useMagicPoints
     * @param array $result
     */
    public function testGetVotesMethod($firstStringsQuotations, $reservesQuotations, $useMagicPoints, $result) {
        $quotationsMock = $this->_createQuotationsMock($firstStringsQuotations, $reservesQuotations);
        $firstStringsFootballerMocks = $this->_createFootballersMock($firstStringsQuotations);
        $reservesFootballerMocks = $this->_createFootballersMock($reservesQuotations);

        $reportCard = ReportCard::getInstance();
        $this->assertSame($result, $reportCard->getVotes(
            $quotationsMock,
            $firstStringsFootballerMocks,
            $reservesFootballerMocks,
            $useMagicPoints
        ));
    }
}
