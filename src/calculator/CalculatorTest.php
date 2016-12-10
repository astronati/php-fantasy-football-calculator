<?php

use \FFC\Calculator as Calculator;

/**
 * @codeCoverageIgnore
 */
class CalculatorTest extends PHPUnit_Framework_TestCase
{
    public function dataProvider()
    {
        return array(
            array(
                array(
                    ['id' => 1, 'vote' => 1, 'magicPoints' => 2],
                    ['id' => 2, 'vote' => 2, 'magicPoints' => 3],
                    ['id' => 3, 'vote' => 3, 'magicPoints' => 4],
                    ['id' => 4, 'vote' => 4, 'magicPoints' => 5],
                    ['id' => 5, 'vote' => 5, 'magicPoints' => 6],
                    ['id' => 6, 'vote' => 6, 'magicPoints' => 7],
                    ['id' => 7, 'vote' => 7, 'magicPoints' => 8],
                    ['id' => 8, 'vote' => 7, 'magicPoints' => 8],
                ),
                array(
                    ['id' => 1, 'type' => 'T', 'order' => '3', 'role' => 'D'],
                    ['id' => 2, 'type' => 'R', 'order' => '3', 'role' => 'D'],
                    ['id' => 3, 'type' => 'T', 'order' => '3', 'role' => 'D'],
                    ['id' => 4, 'type' => 'T', 'order' => '3', 'role' => 'D'],
                    ['id' => 5, 'type' => 'T', 'order' => '3', 'role' => 'D'],
                    ['id' => 6, 'type' => 'R', 'order' => '3', 'role' => 'C'],
                    ['id' => 7, 'type' => 'T', 'order' => '3', 'role' => 'P'],
                ),
                true,
                3,
                [6, 4, 5, 7],
                array(
                    'getSum' => 88,
                    'getDefenseBonus' => 1,
                    'details' => [
                        ['id' => 1, 'vote' => 1, 'magicPoints' => 2],
                        ['id' => 2, 'vote' => 2, 'magicPoints' => 3],
                        ['id' => 3, 'vote' => 3, 'magicPoints' => 4],
                        ['id' => 4, 'vote' => 4, 'magicPoints' => 5],
                        ['id' => 5, 'vote' => 5, 'magicPoints' => 6],
                        ['id' => 6, 'vote' => 6, 'magicPoints' => 7],
                        ['id' => 7, 'vote' => 7, 'magicPoints' => 8],
                    ],
                    'goals' => 3
                )
            )
        );
    }

    private function _createQuotationFactoryMock($quotations)
    {
        // Creates mock for the Quotation Factory
        $quotationFactoryMock = $this->getMockBuilder('FFC\QuotationFactory')
            ->setMethods(array('create'))
            ->getMock();
        // From given quotations creates an array of quotation mocks
        $quotationsMocksMap = array();
        foreach ($quotations as $index => $quotation) {
            $quotationsMocksMap[$index] = array($quotation, $this->_createQuotationMock($quotation));
        }
        // The quotation factory mock will return a quotation mock
        $quotationFactoryMock->method('create')->will($this->returnValueMap($quotationsMocksMap));
        return $quotationFactoryMock;
    }

    private function _createQuotationMock($quotation)
    {
        $quotationMock = $this->getMockBuilder('Quotation')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'getId',
                'toArray'
            ))
            ->getMock();
        $quotationMock->method('getId')->will($this->returnValue($quotation['id']));
        $quotationMock->method('toArray')->will($this->returnValue($quotation));
        return $quotationMock;
    }

    private function _createFootballerMock($footballer)
    {
        // Creates mock for the Footballer
        $footballerMock = $this->getMockBuilder('Footballer')
           ->disableOriginalConstructor()
            ->setMethods(array(
                'getId'
            ))
            ->getMock();
        $footballerMock->method('getId')->will($this->returnValue($footballer['id']));
        return $footballerMock;
    }

    private function _createFormationFactoryMock($footballers)
    {
        // Creates mock for the Formation Factory
        $formationFactoryMock = $this->getMockBuilder('FFC\FormationFactory')
            ->setMethods(array('create'))
            ->getMock();
        $formationFactoryMock->method('create')->will($this->returnValue($this->_createFormationMock($footballers)));
        return $formationFactoryMock;
    }

    private function _createFormationMock($footballers)
    {
        // Creates a mock for the Formation
        $formationMock = $this->getMockBuilder('Formation')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'filterFirstStrings',
                'filterReserves',
                'filterGoalkeepers',
                'filterDefenders',
                'filterMidfielders',
                'filterForwards',
                'getFootballers'
            ))
            ->getMock();
        $formationMock->method('filterFirstStrings')->will($this->returnValue($formationMock));
        $formationMock->method('filterReserves')->will($this->returnValue($formationMock));
        $formationMock->method('filterGoalkeepers')->will($this->returnValue($formationMock));
        $formationMock->method('filterDefenders')->will($this->returnValue($formationMock));
        $formationMock->method('filterMidfielders')->will($this->returnValue($formationMock));
        $formationMock->method('filterForwards')->will($this->returnValue($formationMock));

        // Creates a container for all Footballer mocks
        $footballersMock = array();
        foreach ($footballers as $footballer) {
            array_push($footballersMock, $this->_createFootballerMock($footballer));
        }
        $formationMock->method('getFootballers')->will($this->returnValue($footballersMock));
        return $formationMock;
    }

    private function _createModifierFactoryMock()
    {
        // Creates a mock for the Formation
        $modifierFactoryMock = $this->getMockBuilder('FFC\ModifierFactory')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'createBestDefendersModifier',
                'getBonus',
            ))
            ->getMock();
        $modifierFactoryMock->method('createBestDefendersModifier')->will($this->returnValue($modifierFactoryMock));
        $modifierFactoryMock->method('getBonus')->will($this->returnValueMap(array(
            array(
                array(
                    'goalkeeper' => 6,
                    'defenders' => [6,4,5,7]
                ),
                1
            )
        )));
        return $modifierFactoryMock;
    }

    private function _createConversionTableFactoryMock($value)
    {
        // Creates a mock for the Formation
        $conversionTableFactoryMock = $this->getMockBuilder('FFC\ConversionTableFactory')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'createGoalsConversionTable',
                'getConvertedValue',
            ))
            ->getMock();
        $conversionTableFactoryMock->method('createGoalsConversionTable')->will($this->returnValue($conversionTableFactoryMock));
        $conversionTableFactoryMock->method('getConvertedValue')->will($this->returnValue($value));
        return $conversionTableFactoryMock;
    }

    private function _createReportCardMock($values)
    {
        $reportCardMock = $this->getMockBuilder('FFC\ReportCard')
            ->setMethods(array('getVotes'))
            ->getMock();
        $reportCardMock->method('getVotes')->will($this->returnValue($values));
        return $reportCardMock;
    }

    private function _createCalculatorMock($quotations, $footballers, $isDefenseBonusEnabled, $convertedValue, $reports)
    {
        $quotationFactoryMock = $this->_createQuotationFactoryMock($quotations);
        $formationFactoryMock = $this->_createFormationFactoryMock($footballers);
        $modifierFactoryMock = $this->_createModifierFactoryMock();
        $conversionTableFactoryMock = $this->_createConversionTableFactoryMock($convertedValue);
        $reportCardMock = $this->_createReportCardMock($reports);

        return new Calculator(
            $quotations,
            ['defenseBonus' => $isDefenseBonusEnabled],
            $formationFactoryMock,
            $quotationFactoryMock,
            $modifierFactoryMock,
            $conversionTableFactoryMock,
            $reportCardMock
        );
    }

    /**
     * @dataProvider dataProvider
     * @param array $quotations
     * @param array $footballers
     * @param boolean $isDefenseBonusEnabled
     * @param float $convertedValue
     * @param float[] $reports
     */
    public function testConstructMethod($quotations, $footballers, $isDefenseBonusEnabled, $convertedValue, $reports)
    {
        $this->_createCalculatorMock($quotations, $footballers, $isDefenseBonusEnabled, $convertedValue, $reports);
    }

    /**
     * @dataProvider dataProvider
     * @param array $quotations
     * @param array $footballers
     * @param boolean $isDefenseBonusEnabled
     * @param float $convertedValue
     * @param float[] $reports
     * @param array $result
     */
    public function testGetSumMethod($quotations, $footballers, $isDefenseBonusEnabled, $convertedValue, $reports, $result)
    {
        $calculator = $this->_createCalculatorMock($quotations, $footballers, $isDefenseBonusEnabled, $convertedValue, $reports);
        $this->assertSame($result['getSum'], $calculator->getSum($footballers));
    }

    /**
     * @dataProvider dataProvider
     * @param array $quotations
     * @param array $footballers
     * @param boolean $isDefenseBonusEnabled
     * @param float $convertedValue
     * @param float[] $reports
     * @param array $result
     */
    public function testGetDefenseBonusMethod($quotations, $footballers, $isDefenseBonusEnabled, $convertedValue, $reports, $result)
    {
        $calculator = $this->_createCalculatorMock($quotations, $footballers, $isDefenseBonusEnabled, $convertedValue, $reports);
        $this->assertSame($result['getDefenseBonus'], $calculator->getDefenseBonus($footballers));
    }

    /**
     * @dataProvider dataProvider
     * @param array $quotations
     * @param array $footballers
     * @param boolean $isDefenseBonusEnabled
     * @param float $convertedValue
     * @param float[] $reports
     * @param array $result
     */
    public function testGetFormationDetailsMethod($quotations, $footballers, $isDefenseBonusEnabled, $convertedValue, $reports, $result)
    {
        $calculator = $this->_createCalculatorMock($quotations, $footballers, $isDefenseBonusEnabled, $convertedValue, $reports);
        $this->assertSame($result['details'], $calculator->getFormationDetails($footballers));
    }

    /**
     * @dataProvider dataProvider
     * @param array $quotations
     * @param array $footballers
     * @param boolean $isDefenseBonusEnabled
     * @param float $convertedValue
     * @param float[] $reports
     * @param array $result
     */
    public function testGetGoalsMethod($quotations, $footballers, $isDefenseBonusEnabled, $convertedValue, $reports, $result)
    {
        $calculator = $this->_createCalculatorMock($quotations, $footballers, $isDefenseBonusEnabled, $convertedValue, $reports);
        $this->assertSame($result['goals'], $calculator->getGoals($footballers));
    }
}
