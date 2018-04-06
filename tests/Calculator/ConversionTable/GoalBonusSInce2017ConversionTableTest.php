<?php

namespace Test\Calculator\ConversionTable;

use FFC\Calculator\ConversionTable\GoalBonusSince2017ConversionTable;
use PHPUnit\Framework\TestCase;

class GoalBonusSInce2017ConversionTableTest extends TestCase
{
    public function dataProvider()
    {
        return [
          ['P', 5],
          ['D', 4.5],
          ['C', 4],
          ['T', 3.5],
          ['A', 3],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param int $value
     * @param int $expectedConvertedValue
     */
    public function testConvert($value, $expectedConvertedValue)
    {
        $conversionTable = new GoalBonusSince2017ConversionTable();
        $this->assertSame($expectedConvertedValue, $conversionTable->convert($value));
    }
}
