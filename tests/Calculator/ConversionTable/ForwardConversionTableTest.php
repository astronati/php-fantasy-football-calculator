<?php

namespace Test\Calculator\ConversionTable;

use FFC\Calculator\ConversionTable\ForwardConversionTable;
use PHPUnit\Framework\TestCase;

class ForwardConversionTableTest extends TestCase
{
    public function dataProvider()
    {
        return [
          [8.1, 2],
          [8, 2],
          [7.9, 1.5],
          [7.6, 1.5],
          [7.5, 1.5],
          [7.4, 1],
          [7.1, 1],
          [7, 1],
          [6.9, 0.5],
          [6.6, 0.5],
          [6.5, 0.5],
          [6.4, 0],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param int $value
     * @param int $expectedConvertedValue
     */
    public function testConvert($value, $expectedConvertedValue)
    {
        $conversionTable = new ForwardConversionTable();
        $this->assertSame($expectedConvertedValue, $conversionTable->convert($value));
    }
}
