<?php

use \FFC\ForwardConversionTable as ForwardConversionTable;

/**
 * @codeCoverageIgnore
 */
class ForwardConversionTableTest extends PHPUnit_Framework_TestCase
{
    public function forwardVoteProvider()
    {
        return array(
            [0, 0],
            [6.49, 0],
            [6.5, 0.5],
            [6.99, 0.5],
            [7, 1],
            [7.49, 1],
            [7.5, 1.5],
            [7.99, 1.5],
            [8, 2],
            [9, 2],
        );
    }

    /**
     * @dataProvider forwardVoteProvider
     * @param integer $value
     * @param integer $result
     */
    public function testGetConvertedValue($value, $result)
    {
        $conversionTable = new ForwardConversionTable();
        $this->assertSame($result, $conversionTable->getConvertedValue($value));
    }
}
