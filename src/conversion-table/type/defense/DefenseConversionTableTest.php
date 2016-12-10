<?php

use \FFC\DefenseConversionTable as DefenseConversionTable;

/**
 * @codeCoverageIgnore
 */
class DefenseConversionTableTest extends PHPUnit_Framework_TestCase
{
    public function defenseAverageProvider()
    {
        return array(
            [0, 4],
            [4.9, 4],
            [5, 3],
            [5.24, 3],
            [5.25, 2],
            [5.49, 2],
            [5.5, 1],
            [5.74, 1],
            [5.75, 0],
            [5.99, 0],
            [6, -1],
            [6.24, -1],
            [6.25, -2],
            [6.49, -2],
            [6.5, -3],
            [6.74, -3],
            [6.75, -4],
            [6.99, -4],
            [7, -5],
            [8, -5],
        );
    }

    /**
     * @dataProvider defenseAverageProvider
     * @param integer $value
     * @param integer $result
     */
    public function testGetConvertedValue($value, $result)
    {
        $conversionTable = new DefenseConversionTable();
        $this->assertSame($result, $conversionTable->getConvertedValue($value));
    }
}
