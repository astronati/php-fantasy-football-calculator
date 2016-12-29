<?php

use \FFC\ReportCard as ReportCard;

/**
 * @codeCoverageIgnore
 */
class ReportCardTest extends PHPUnit_Framework_TestCase
{

    private function _quotations()
    {
        return array(
            ['footballerID' => 1, 'vote' => 5, 'magicPoints' => 6],
            ['footballerID' => 2, 'vote' => 6, 'magicPoints' => 7],
            ['footballerID' => 3, 'vote' => 7, 'magicPoints' => 8],
            ['footballerID' => 4, 'vote' => 8, 'magicPoints' => 9],
            ['footballerID' => 5, 'vote' => null, 'magicPoints' => 6],
            ['footballerID' => 6, 'vote' => 6, 'magicPoints' => 0],
            ['footballerID' => 7, 'vote' => 5, 'magicPoints' => 4],
            ['footballerID' => 8, 'vote' => 6, 'magicPoints' => 5.5],
            ['footballerID' => 9, 'vote' => null, 'magicPoints' => null],
            ['footballerID' => 10, 'vote' => null, 'magicPoints' => null],
            ['footballerID' => 11, 'vote' => 5, 'magicPoints' => 6.5],
        );
    }

    public function detailsDataProvider()
    {
        return array(
            [
                // Footballers
                [
                    ['footballerID' => 1],
                    ['footballerID' => 2],
                    ['footballerID' => 3],
                    ['footballerID' => 4],
                ],
                // Expected result
                [
                    1 => ['footballerID' => 1, 'vote' => 5, 'magicPoints' => 6],
                    2 => ['footballerID' => 2, 'vote' => 6, 'magicPoints' => 7],
                    3 => ['footballerID' => 3, 'vote' => 7, 'magicPoints' => 8],
                    4 => ['footballerID' => 4, 'vote' => 8, 'magicPoints' => 9],
                ],
            ],
            [
                // Footballers
                [
                    ['footballerID' => 5],
                    ['footballerID' => 6],
                    ['footballerID' => 9],
                    ['footballerID' => 10],
                ],
                // Expected result
                [
                    5 => ['footballerID' => 5, 'vote' => null, 'magicPoints' => 6],
                    6 => ['footballerID' => 6, 'vote' => 6, 'magicPoints' => 0],
                    9 => ['footballerID' => 9, 'vote' => null, 'magicPoints' => null],
                    10 => ['footballerID' => 10, 'vote' => null, 'magicPoints' => null],
                ],
            ],
            [
                // Footballers
                [
                    ['footballerID' => 8],
                    ['footballerID' => 11]
                ],
                // Expected result
                [
                    8 => ['footballerID' => 8, 'vote' => 6, 'magicPoints' => 5.5],
                    11 => ['footballerID' => 11, 'vote' => 5, 'magicPoints' => 6.5],
                ],
            ],
        );
    }

    public function magicPointsDataProvider()
    {
        return array(
            [
                // Footballers
                [
                    ['footballerID' => 1],
                    ['footballerID' => 2],
                    ['footballerID' => 3],
                    ['footballerID' => 4],
                ],
                // Expected result
                [6, 7, 8, 9],
            ],
            [
                // Footballers
                [
                    ['footballerID' => 5],
                    ['footballerID' => 6],
                    ['footballerID' => 9],
                    ['footballerID' => 10],
                ],
                // Expected result
                [6, 0, null, null],
            ],
            [
                // Footballers
                [
                    ['footballerID' => 8],
                    ['footballerID' => 11]
                ],
                // Expected result
                [5.5, 6.5],
            ],
        );
    }

    public function votesDataProvider()
    {
        return array(
            [
                // Footballers
                [
                    ['footballerID' => 1],
                    ['footballerID' => 2],
                    ['footballerID' => 3],
                    ['footballerID' => 4],
                ],
                // Expected result
                [5, 6, 7, 8],
            ],
            [
                // Footballers
                [
                    ['footballerID' => 5],
                    ['footballerID' => 6],
                    ['footballerID' => 9],
                    ['footballerID' => 10],
                ],
                // Expected result
                [6, 6, null, null],
            ],
            [
                // Footballers
                [
                    ['footballerID' => 8],
                    ['footballerID' => 11]
                ],
                // Expected result
                [6, 5],
            ],
        );
    }

    public function indemnifyDataProvider()
    {
        return array(
            [
                // Votes
                [5, 6, 7, 8],
                // Reserves
                [9, 10, 11, 12],
                // Expected result
                [5, 6, 7, 8],
            ],
            [
                // Votes
                [5, 6, null, 8],
                // Reserves
                [9, 10, 11, 12],
                // Expected result
                [5, 6, 9, 8],
            ],
            [
                // Votes
                [null, 6, null, 8],
                // Reserves
                [9, 10, 11, 12],
                // Expected result
                [9, 6, 10, 8],
            ],
            [
                // Votes
                [null, 6, null, null],
                // Reserves
                [9, 10, 11, 12],
                // Expected result
                [9, 6, 10, 11],
            ],
            [
                // Votes
                [null, 6, null, null],
                // Reserves
                [9, 10],
                // Expected result
                [9, 6, 10, null],
            ],
        );
    }

    private function _createFootballersMock($footballers)
    {
        $footballersMock = array();
        foreach ($footballers as $footballer) {
            $footballerMock = $this->getMockBuilder('Footballer')
                ->disableOriginalConstructor()
                ->setMethods([
                    'getId',
                ])
                ->getMock();
            $footballerMock->method('getId')->will($this->returnValue($footballer['footballerID']));
            array_push($footballersMock, $footballerMock);
        }
        return $footballersMock;
    }

    private function _createQuotationMock($quotation)
    {
        $quotationMock = $this->getMockBuilder('Quotation')
            ->disableOriginalConstructor()
            ->setMethods([
                'getFootballerId',
                'getVote',
                'getMagicPoints',
                'toArray',
            ])
            ->getMock();
        $quotationMock->method('getFootballerId')->will($this->returnValue($quotation['footballerID']));
        $quotationMock->method('getVote')->will($this->returnValue($quotation['vote']));
        $quotationMock->method('getMagicPoints')->will($this->returnValue($quotation['magicPoints']));
        $quotationMock->method('toArray')->will($this->returnValue($quotation));
        return $quotationMock;
    }

    private function _createQuotationFactoryMock($quotations)
    {
        // Creates mock for the Quotation Factory
        $quotationFactoryMock = $this->getMockBuilder('FFC\QuotationFactory')
            ->setMethods(['create'])
            ->getMock();
        // From given quotations creates an array of quotation mocks
        $quotationsMocksMap = array();
        foreach ($quotations as $index => $quotation) {
            $quotationsMocksMap[$index] = [$quotation, $this->_createQuotationMock($quotation)];
        }
        // The quotation factory mock will return a quotation mock
        $quotationFactoryMock->method('create')->will($this->returnValueMap($quotationsMocksMap));
        return $quotationFactoryMock;
    }

    /**
     * @dataProvider detailsDataProvider
     * @param array $footballersConfig
     * @param array $result
     */
    public function testGetDetailsMethod($footballersConfig, $result)
    {
        $footballers = $this->_createFootballersMock($footballersConfig);
        $reportCard = new ReportCard($this->_quotations(), $this->_createQuotationFactoryMock($this->_quotations()));
        $this->assertSame($result, $reportCard->getDetails($footballers));
    }

    /**
     * @dataProvider magicPointsDataProvider
     * @param array $footballersConfig
     * @param array $result
     */
    public function testGetMagicPointsMethod($footballersConfig, $result)
    {
        $footballers = $this->_createFootballersMock($footballersConfig);
        $reportCard = new ReportCard($this->_quotations(), $this->_createQuotationFactoryMock($this->_quotations()));
        $this->assertSame($result, $reportCard->getMagicPoints($footballers));
    }

    /**
     * @dataProvider votesDataProvider
     * @param array $footballersConfig
     * @param array $result
     */
    public function testGetVotesMethod($footballersConfig, $result)
    {
        $footballers = $this->_createFootballersMock($footballersConfig);
        $reportCard = new ReportCard($this->_quotations(), $this->_createQuotationFactoryMock($this->_quotations()));
        $this->assertSame($result, $reportCard->getVotes($footballers));
    }

    /**
     * @dataProvider indemnifyDataProvider
     * @param array $votes
     * @param array $reserves
     * @param array $result
     */
    public function testIndemnifyMethod($votes, $reserves, $result)
    {
        $reportCard = new ReportCard($this->_quotations(), $this->_createQuotationFactoryMock($this->_quotations()));
        $this->assertSame($result, $reportCard->indemnify($votes, $reserves));
    }
}
