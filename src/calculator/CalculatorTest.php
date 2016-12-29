<?php

use \FFC\Calculator as Calculator;

/**
 * @codeCoverageIgnore
 */
class CalculatorTest extends PHPUnit_Framework_TestCase
{
    private $_footballers = array(
        ['id' => 1, 'type' => 'T', 'order' => '3', 'role' => 'D'],
        ['id' => 2, 'type' => 'R', 'order' => '3', 'role' => 'D'],
        ['id' => 3, 'type' => 'T', 'order' => '3', 'role' => 'D'],
        ['id' => 4, 'type' => 'T', 'order' => '3', 'role' => 'D'],
        ['id' => 5, 'type' => 'T', 'order' => '3', 'role' => 'D'],
        ['id' => 6, 'type' => 'R', 'order' => '3', 'role' => 'C'],
        ['id' => 7, 'type' => 'T', 'order' => '3', 'role' => 'P']
    );

    public function goalsProvider()
    {
        return [
            [66, 1],
            [72, 2],
            [78, 3],
        ];
    }

    private function _createFootballerMock($footballer)
    {
        // Creates mock for the Footballer
        $footballerMock = $this->getMockBuilder('Footballer')
           ->disableOriginalConstructor()
            ->setMethods([
                'getId'
            ])
            ->getMock();
        $footballerMock->method('getId')->will($this->returnValue($footballer['id']));
        return $footballerMock;
    }

    private function _createFormationFactoryMock()
    {
        // Creates mock for the Formation Factory
        $formationFactoryMock = $this->getMockBuilder('FFC\FormationFactory')
            ->setMethods(['create'])
            ->getMock();
        $formationFactoryMock->method('create')->will($this->returnValue(
            $this->_createFormationMock($this->_footballers)
        ));
        return $formationFactoryMock;
    }

    private function _createFormationMock($footballers)
    {
        // Creates a mock for the Formation
        $formationMock = $this->getMockBuilder('FFC\Formation')
            ->disableOriginalConstructor()
            ->setMethods([
                'filterFirstStrings',
                'filterReserves',
                'filterGoalkeepers',
                'filterDefenders',
                'filterMidfielders',
                'filterForwards',
                'getFootballers'
            ])
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
            ->setMethods([
                'createBestDefendersModifier',
                'createDefenseModifier',
                'createMidfieldModifier',
                'createForwardModifier',
                'getBonus',
            ])
            ->getMock();
        $modifierFactoryMock->method('createBestDefendersModifier')->will($this->returnValue($modifierFactoryMock));
        $modifierFactoryMock->method('createDefenseModifier')->will($this->returnValue($modifierFactoryMock));
        $modifierFactoryMock->method('createMidfieldModifier')->will($this->returnValue($modifierFactoryMock));
        $modifierFactoryMock->method('createForwardModifier')->will($this->returnValue($modifierFactoryMock));
        $modifierFactoryMock->method('getBonus')->will($this->returnValue(1));
        return $modifierFactoryMock;
    }

    private function _createConversionTableFactoryMock()
    {
        // Creates a mock for the Formation
        $conversionTableFactoryMock = $this->getMockBuilder('FFC\ConversionTableFactory')
            ->disableOriginalConstructor()
            ->setMethods([
                'createGoalsConversionTable',
                'getConvertedValue',
            ])
            ->getMock();
        $conversionTableFactoryMock->method('createGoalsConversionTable')
            ->will($this->returnValue($conversionTableFactoryMock));
        $conversionTableFactoryMock->method('getConvertedValue')
            ->will($this->returnValueMap([
                [66, 1],
                [72, 2],
                [78, 3],
            ]));
        return $conversionTableFactoryMock;
    }

    private function _createReportCardMock()
    {
        $reportCardMock = $this->getMockBuilder('FFC\ReportCard')
            ->disableOriginalConstructor()
            ->setMethods([
                'getMagicPoints',
                'getVotes',
                'getDetails',
                'indemnify',
            ])
            ->getMock();
        $reportCardMock->method('getMagicPoints')->will($this->returnValue([6,5,5,5]));
        $reportCardMock->method('getVotes')->will($this->returnValue([4,5,5,5]));
        $reportCardMock->method('getDetails')->will($this->returnValue([6,5,5,6]));
        $reportCardMock->method('indemnify')->will($this->returnValue([5,5,5,5]));
        return $reportCardMock;
    }

    private function _createCalculatorMock()
    {
        $formationFactoryMock = $this->_createFormationFactoryMock();
        $modifierFactoryMock = $this->_createModifierFactoryMock();
        $conversionTableFactoryMock = $this->_createConversionTableFactoryMock();
        $reportCardMock = $this->_createReportCardMock();

        return new Calculator(
            $formationFactoryMock,
            $modifierFactoryMock,
            $conversionTableFactoryMock,
            $reportCardMock
        );
    }

    public function testConstructMethod()
    {
        $this->_createCalculatorMock();
    }

    public function testGetBonusMethod() {
        $calculator = $this->_createCalculatorMock();
        $this->assertSame($calculator->getBonus([]), [
            'bestDefenders' => 1
        ]);
        $this->assertSame($calculator->getBonus([], [1]), [
            'bestDefenders' => 1,
            'defense' => 1,
            'midfield' => 1,
            'forward' => 1
        ]);
    }

    public function testGetSumMethod() {
        $calculator = $this->_createCalculatorMock();
        $this->assertSame($calculator->getSum([]), 80);
    }

    public function testGetFormationDetailsMethod() {
        $calculator = $this->_createCalculatorMock();
        $this->assertSame($calculator->getFormationDetails([]), [6,5,5,6]);
    }

    /**
     * @dataProvider goalsProvider
     * @param integer $sum
     * @param integer $result
     */
    public function testGetGoalsMethod($sum, $result) {
        $calculator = $this->_createCalculatorMock();
        $this->assertSame($calculator->getGoals($sum), $result);
    }
}
