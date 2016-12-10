<?php

use \FFC\MidfieldConversionTable as MidfieldConversionTable;

/**
 * @codeCoverageIgnore
 */
class MidfieldConversionTableTest extends PHPUnit_Framework_TestCase
{
    public function midfieldDifferenceProvider()
    {
        return array(
            [0, 0],
            [0.9, 0],
            [1, 0.5],
            [1.9, 0.5],
            [2, 1],
            [2.9, 1],
            [3, 1.5],
            [3.9, 1.5],
            [4, 2],
            [4.9, 2],
            [5, 2.5],
            [5.9, 2.5],
            [6, 3],
            [6.9, 3],
            [7, 3.5],
            [7.9, 3.5],
            [8, 4],
            [8.9, 4],
        );
    }

    /**
     * @dataProvider midfieldDifferenceProvider
     * @param integer $value
     * @param integer $result
     */
    public function testGetConvertedValue($value, $result)
    {
        $conversionTable = new MidfieldConversionTable();
        $this->assertSame($result, $conversionTable->getConvertedValue($value));
    }
}
