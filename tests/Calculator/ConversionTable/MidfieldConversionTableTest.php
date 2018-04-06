<?php

namespace Test\Calculator\ConversionTable;

use FFC\Calculator\ConversionTable\MidfieldConversionTable;
use PHPUnit\Framework\TestCase;

class MidfieldConversionTableTest extends TestCase
{
    public function dataProvider()
    {
        return [
          [8.1, 4],
          [8, 4],
          [7.9, 3.5],
          [7.1, 3.5],
          [7, 3.5],
          [6.9, 3],
          [6.1, 3],
          [6, 3],
          [5.9, 2.5],
          [5.1, 2.5],
          [5, 2.5],
          [4.9, 2],
          [4.1, 2],
          [4, 2],
          [3.9, 1.5],
          [3.1, 1.5],
          [3, 1.5],
          [2.9, 1],
          [2.1, 1],
          [2, 1],
          [1.9, 0.5],
          [1.1, 0.5],
          [1, 0.5],
          [0.9, 0],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param int $value
     * @param int $expectedConvertedValue
     */
    public function testConvert($value, $expectedConvertedValue)
    {
        $conversionTable = new MidfieldConversionTable();
        $this->assertSame($expectedConvertedValue, $conversionTable->convert($value));
    }
}
