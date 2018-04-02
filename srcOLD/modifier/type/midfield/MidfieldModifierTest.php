<?php

use \FFC\MidfieldModifier as MidfieldModifier;

/**
 * @codeCoverageIgnore
 */
class MidfieldModifierTest extends PHPUnit_Framework_TestCase
{
    public function midfieldersProvider()
    {
        return [
            [[5, 6, 6, 7], [7, 7, 7, 7], -1],
            [[6, 6, 7], [7, 7, 7, 7], -1],
            [[6, 7.5, 6.5, 5], [5, 5, 5], 1.5],
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
            [1, 1],
            [1.25, 1.5],
        ]));
        return $conversionTableMock;
    }

    /**
     * @dataProvider midfieldersProvider
     * @param float[] $home
     * @param float[] $away
     * @param float $result
     */
    public function testGetConvertedValue($home, $away, $result)
    {
        $modifier = new MidfieldModifier($this->_createConversionTableMock($result));
        $this->assertSame($result, $modifier->getBonus([
            'home' => $home,
            'away' => $away,
        ]));
    }
}
