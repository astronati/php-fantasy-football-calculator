<?php

use \FFC\DefenseModifier as DefenseModifier;

/**
 * @codeCoverageIgnore
 */
class DefenseModifierTest extends PHPUnit_Framework_TestCase
{
    public function defenseProvider()
    {
        return [
            [[5, 5, 5, 5], -5],
            [[5, 5, 5], -4],
            [[6, 6, 6, 6], -6],
            [[6, 6, 6, 6, 6, 6], -8],
        ];
    }

    private function _createConversionTableMock()
    {
        $conversionTableMock = $this->getMockBuilder('FFC\ConversionTableAbstract')
            ->setMethods([
                'getConvertedValue',
            ])
            ->getMock();
        $conversionTableMock->method('getConvertedValue')->will($this->returnValueMap([
            [5, -5],
            [6, -6],
        ]));
        return $conversionTableMock;
    }

    /**
     * @dataProvider defenseProvider
     * @param float[] $defenders
     * @param float $result
     */
    public function testGetConvertedValue($defenders, $result)
    {
        $modifier = new DefenseModifier($this->_createConversionTableMock($result));
        $this->assertSame($result, $modifier->getBonus([
            'defenders' => $defenders,
        ]));
    }
}
