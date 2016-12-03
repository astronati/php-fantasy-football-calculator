<?php

use \FFC\ConversionTable as ConversionTable;

class ConversionTableTest extends PHPUnit_Framework_TestCase {

    public function teamPointsProvider() {
        return array(
            array(0, 0),
            array(65.5, 0),
            array(66, 1),
            array(71.5, 1),
            array(72, 2),
            array(77.5, 2),
            array(78, 3),
            array(83.5, 3),
            array(84, 4),
            array(89.5, 4),
            array(90, 5),
            array(95.5, 5),
            array(96, 6),
            array(101.5, 6),
            array(102, 7),
            array(107.5, 7),
            array(108, 8),
            array(113.5, 8),
            array(114, 9),
            array(119.5, 9),
            array(120, 10),
            array(130, 10),
        );
    }

    public function averagesProvider() {
        return array(
            array(0, 0),
            array(5.9, 0),
            array(6, 1),
            array(6.49, 1),
            array(6.5, 3),
            array(6.99, 3),
            array(7, 6),
            array(7.5, 6),
        );
    }

    /**
     * @dataProvider teamPointsProvider
     * @param integer $value
     * @param integer $result
     */
    public function testGetGoalsMethod($value, $result) {
        $conversionTable = ConversionTable::getInstance();
        $this->assertSame($result, $conversionTable->getGoals($value));
    }

    /**
     * @dataProvider averagesProvider
     * @param integer $value
     * @param integer $result
     */
    public function testGetDefenseBonusMethod($value, $result) {
        $conversionTable = ConversionTable::getInstance();
        $this->assertSame($result, $conversionTable->getDefenseBonus($value));
    }
}
