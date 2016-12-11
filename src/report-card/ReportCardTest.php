<?php

use \FFC\ReportCard as ReportCard;

/**
 * @codeCoverageIgnore
 */
class ReportCardTest extends PHPUnit_Framework_TestCase {

    public function dataProvider() {
        return array(
            [
                // First Strings Quotations
                [
                    ['id' => 1, 'vote' => 5, 'magicPoints' => 6],
                    ['id' => 2, 'vote' => 6, 'magicPoints' => 7],
                    ['id' => 3, 'vote' => 7, 'magicPoints' => 8],
                    ['id' => 4, 'vote' => 8, 'magicPoints' => 9],
                ],
                // Reserves Quotations
                [
                    ['id' => 5, 'vote' => 4, 'magicPoints' => 5],
                    ['id' => 6, 'vote' => 3, 'magicPoints' => 4],
                ],
                // Use magic points
                true,
                // Expected result
                [6,7,8,9],
            ],
            [
                [
                    ['id' => 1, 'vote' => 5, 'magicPoints' => 6],
                    ['id' => 2, 'vote' => null, 'magicPoints' => 7],
                    ['id' => 3, 'vote' => 7, 'magicPoints' => 8],
                    ['id' => 4, 'vote' => 8, 'magicPoints' => 9],
                ],
                [
                    ['id' => 5, 'vote' => null, 'magicPoints' => 5],
                    ['id' => 6, 'vote' => 3, 'magicPoints' => 4],
                ],
                true,
                [6,7,8,9],
            ],
            [
                [
                    ['id' => 1, 'vote' => 5, 'magicPoints' => 6],
                    ['id' => 2, 'vote' => 6, 'magicPoints' => 7],
                    ['id' => 3, 'vote' => 7, 'magicPoints' => 8],
                    ['id' => 4, 'vote' => 8, 'magicPoints' => 9],
                ],
                [
                    ['id' => 5, 'vote' => 4, 'magicPoints' => 5],
                    ['id' => 6, 'vote' => 3, 'magicPoints' => 4],
                ],
                false,
                [5,6,7,8],
            ],
            [
                [
                    ['id' => 1, 'vote' => 5, 'magicPoints' => 6],
                    ['id' => 2, 'vote' => 6, 'magicPoints' => 7],
                    ['id' => 3, 'vote' => 7, 'magicPoints' => 8],
                ],
                [
                    ['id' => 4, 'vote' => 4, 'magicPoints' => 5],
                    ['id' => 5, 'vote' => 3, 'magicPoints' => 4],
                ],
                false,
                [5,6,7],
            ],
            [
                [
                    ['id' => 1, 'vote' => 5, 'magicPoints' => 6],
                    ['id' => 2, 'vote' => 6, 'magicPoints' => 7],
                    ['id' => 3, 'vote' => 7, 'magicPoints' => 8],
                ],
                [
                    ['id' => 4, 'vote' => 4, 'magicPoints' => 5],
                    ['id' => 5, 'vote' => 3, 'magicPoints' => 4],
                ],
                true,
                [6,7,8],
            ],
            [
                [
                    ['id' => 1, 'vote' => null, 'magicPoints' => null],
                    ['id' => 2, 'vote' => 6, 'magicPoints' => 6.5],
                    ['id' => 3, 'vote' => 7, 'magicPoints' => 7],
                ],
                [
                    ['id' => 4, 'vote' => 4, 'magicPoints' => 5],
                    ['id' => 5, 'vote' => 3, 'magicPoints' => 4],
                ],
                true,
                [5,6.5,7],
            ],
            [
                [
                    ['id' => 1, 'vote' => 5, 'magicPoints' => 0],
                    ['id' => 2, 'vote' => 6, 'magicPoints' => 6.5],
                    ['id' => 3, 'vote' => 7, 'magicPoints' => 7],
                ],
                [
                    ['id' => 4, 'vote' => 4, 'magicPoints' => 6],
                    ['id' => 5, 'vote' => 3, 'magicPoints' => 4],
                ],
                true,
                [0,6.5,7],
            ],
            [
                [
                    ['id' => 1, 'vote' => 5, 'magicPoints' => 0],
                    ['id' => 2, 'vote' => 6, 'magicPoints' => 6.5],
                    ['id' => 3, 'vote' => 7, 'magicPoints' => 7],
                ],
                [
                    ['id' => 4, 'vote' => 4, 'magicPoints' => 6],
                    ['id' => 5, 'vote' => 3, 'magicPoints' => 4],
                ],
                false,
                [5,6,7],
            ],
        );
    }

    private function _createFootballersMock($footballers) {
        $footballersMock = array();
        foreach ($footballers as $footballer) {
            $footballerMock = $this->getMockBuilder('Footballer')
                ->disableOriginalConstructor()
                ->setMethods([
                    'getId',
                ])
                ->getMock();
            $footballerMock->method('getId')->will($this->returnValue($footballer['id']));
            array_push($footballersMock, $footballerMock);
        }
        return $footballersMock;
    }

    private function _createQuotationMock($quotation) {
        $quotationMock = $this->getMockBuilder('Quotation')
            ->disableOriginalConstructor()
            ->setMethods([
                'getVote',
                'getMagicPoints',
            ])
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
