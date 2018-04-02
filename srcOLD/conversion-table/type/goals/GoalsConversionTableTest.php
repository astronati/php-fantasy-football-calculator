<?php

use \FFC\GoalsConversionTable as GoalsConversionTable;

/**
 * @codeCoverageIgnore
 */
class GoalsConversionTableTest extends PHPUnit_Framework_TestCase
{
    public function goalsProvider()
    {
        return [
            [0, 0],
            [65.9, 0],
            [66, 1],
            [71.9, 1],
            [72, 2],
            [77.9, 2],
            [78, 3],
            [83.9, 3],
            [84, 4],
            [89.9, 4],
            [90, 5],
            [95.9, 5],
            [96, 6],
            [101.9, 6],
            [102, 7],
            [107.9, 7],
            [108, 8],
            [113.9, 8],
            [114, 9],
            [119.9, 9],
            [120, 10],
            [130, 10],
        ];
    }

    /**
     * @dataProvider goalsProvider
     * @param integer $value
     * @param integer $result
     */
    public function testGetConvertedValue($value, $result)
    {
        $conversionTable = new GoalsConversionTable();
        $this->assertSame($result, $conversionTable->getConvertedValue($value));
    }
}
