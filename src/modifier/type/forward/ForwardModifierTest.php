<?php

use \FFC\ForwardModifier as ForwardModifier;

/**
 * @codeCoverageIgnore
 */
class ForwardModifierTest extends PHPUnit_Framework_TestCase
{
    public function forwardsProvider()
    {
        return [
            [[5, 6, 4, 7], 22],
            [[5, 5, 5, 6], 21],
            [[], 0],
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
            [4, 4],
            [5, 5],
            [6, 6],
            [7, 7],
        ]));
        return $conversionTableMock;
    }

    /**
     * @dataProvider forwardsProvider
     * @param float[] $forwards
     * @param float $result
     */
    public function testGetConvertedValue($forwards, $result)
    {
        $modifier = new ForwardModifier($this->_createConversionTableMock($result));
        $this->assertSame($result, $modifier->getBonus([
            'forwards' => $forwards,
        ]));
    }
}
