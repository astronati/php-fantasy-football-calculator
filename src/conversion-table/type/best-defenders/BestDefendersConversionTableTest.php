<?php

use \FFC\BestDefendersConversionTable as BestDefendersConversionTable;

/**
 * @codeCoverageIgnore
 */
class BestDefendersConversionTableTest extends PHPUnit_Framework_TestCase
{
    public function bestDefendersAverageProvider()
    {
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
     * @dataProvider bestDefendersAverageProvider
     * @param integer $value
     * @param integer $result
     */
    public function testGetConvertedValue($value, $result)
    {
        $conversionTable = new BestDefendersConversionTable();
        $this->assertSame($result, $conversionTable->getConvertedValue($value));
    }
}
