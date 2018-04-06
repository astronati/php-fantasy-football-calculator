<?php

namespace Test\Calculator\ConversionTable;

use FFC\Calculator\ConversionTable\DefenseConversionTable;
use PHPUnit\Framework\TestCase;

class DefensConversionTableTest extends TestCase
{
    public function dataProvider()
    {
        return [
          [7.05, -5],
          [7, -5],
          [6.95, -4],
          [6.8, -4],
          [6.75, -4],
          [6.7, -3],
          [6.55, -3],
          [6.5, -3],
          [6.45, -2],
          [6.3, -2],
          [6.25, -2],
          [6.2, -1],
          [6.05, -1],
          [6, -1],
          [5.95, 0],
          [5.8, 0],
          [5.75, 0],
          [5.7, 1],
          [5.55, 1],
          [5.5, 1],
          [5.45, 2],
          [5.3, 2],
          [5.25, 2],
          [5.2, 3],
          [5.05, 3],
          [5, 3],
          [4.95, 4],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param int $value
     * @param int $expectedConvertedValue
     */
    public function testConvert($value, $expectedConvertedValue)
    {
        $conversionTable = new DefenseConversionTable();
        $this->assertSame($expectedConvertedValue, $conversionTable->convert($value));
    }
}
