<?php

namespace Test\Calculator\ConversionTable;

use FFC\Calculator\ConversionTable\BestDefendersConversionTable;
use PHPUnit\Framework\TestCase;

class BestDefendersConversionTableTest extends TestCase
{
    public function dataProvider()
    {
        return [
          [7.1, 6],
          [7, 6],
          [6.9, 3],
          [6.6, 3],
          [6.5, 3],
          [6.4, 1],
          [6.1, 1],
          [6, 1],
          [5.9, 0],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param int $value
     * @param int $expectedConvertedValue
     */
    public function testConvert($value, $expectedConvertedValue)
    {
        $conversionTable = new BestDefendersConversionTable();
        $this->assertSame($expectedConvertedValue, $conversionTable->convert($value));
    }
}
