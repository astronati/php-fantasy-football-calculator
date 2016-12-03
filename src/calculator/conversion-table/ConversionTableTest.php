<?php

use \FFC\ConversionTable as ConversionTable;

class ConversionTableTest extends PHPUnit_Framework_TestCase {

    public function teamPointsProvider() {
        return array(
            [0, 0],
            [65.5, 0],
            [66, 1],
            [71.5, 1],
            [72, 2],
            [77.5, 2],
            [78, 3],
            [83.5, 3],
            [84, 4],
            [89.5, 4],
            [90, 5],
            [95.5, 5],
            [96, 6],
            [101.5, 6],
            [102, 7],
            [107.5, 7],
            [108, 8],
            [113.5, 8],
            [114, 9],
            [119.5, 9],
            [120, 10],
            [130, 10],
        );
    }

    public function averagesProvider() {
        return array(
            [0, 0],
            [5.9, 0],
            [6, 1],
            [6.49, 1],
            [6.5, 3],
            [6.99, 3],
            [7, 6],
            [7.5, 6],
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
