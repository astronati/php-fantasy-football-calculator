<?php

use \FFC\BestDefendersModifier as BestDefendersModifier;

/**
 * @codeCoverageIgnore
 */
class BestDefendersModifierTest extends PHPUnit_Framework_TestCase
{
    public function defendersProvider()
    {
        return array(
            array(6, [5, 6, 4, 7], 6),
            array(6, [5, 5, 5, 6], 5.5),
        );
    }

    private function _createConversionTableMock()
    {
        $conversionTableMock = $this->getMockBuilder('FFC\ConversionTableAbstract')
            ->setMethods(array(
                'getConvertedValue',
            ))
            ->getMock();
        $conversionTableMock->method('getConvertedValue')->will($this->returnValueMap(array(
            array(6, 6),
            array(5.5, 5.5),
        )));
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
