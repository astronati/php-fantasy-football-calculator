<?php

namespace Test\Calculator\ConversionTable;

use FFC\Calculator\ConversionTable\GoalConversionTable;
use PHPUnit\Framework\TestCase;

class GoalConversionTableTest extends TestCase
{
    public function dataProvider()
    {
        return [
          [120.5, 10],
          [120, 10],
          [119.5, 9],
          [114.5, 9],
          [114, 9],
          [113.5, 8],
          [108.5, 8],
          [108, 8],
          [107.5, 7],
          [102.5, 7],
          [102, 7],
          [101.5, 6],
          [96.5, 6],
          [96, 6],
          [95.5, 5],
          [90.5, 5],
          [90, 5],
          [89.5, 4],
          [84.5, 4],
          [84, 4],
          [83.5, 3],
          [78.5, 3],
          [78, 3],
          [77.5, 2],
          [72.5, 2],
          [72, 2],
          [71.5, 1],
          [66.5, 1],
          [66, 1],
          [65.5, 0],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param int $value
     * @param int $expectedConvertedValue
     */
    public function testConvert($value, $expectedConvertedValue)
    {
        $conversionTable = new GoalConversionTable();
        $this->assertSame($expectedConvertedValue, $conversionTable->convert($value));
    }
}
