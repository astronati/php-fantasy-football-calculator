<?php

use \FFC\BestDefendersModifier as BestDefendersModifier;

/**
 * @codeCoverageIgnore
 */
class BestDefendersModifierTest extends PHPUnit_Framework_TestCase
{
    public function defendersProvider()
    {
        return [
            [6, [5, 6, 4, 7], 6],
            [6, [5, 5, 5, 6], 5.5],
            [6, [7, 7, 7], 0],
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
            [6, 6],
            [5.5, 5.5],
        ]));
        return $conversionTableMock;
    }

    /**
     * @dataProvider defendersProvider
     * @param float $goalkeeper
     * @param float[] $defenders
     * @param float $result
     */
    public function testGetConvertedValue($goalkeeper, $defenders, $result)
    {
        $modifier = new BestDefendersModifier($this->_createConversionTableMock($result));
        $this->assertSame($result, $modifier->getBonus([
            'goalkeeper' => $goalkeeper,
            'defenders' => $defenders,
        ]));
    }
}
