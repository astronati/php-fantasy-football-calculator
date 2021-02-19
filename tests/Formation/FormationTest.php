<?php

namespace Test\Formation;

use FFC\Formation\Footballer\FootballerAbstract;
use FFC\Formation\Formation;
use PHPUnit\Framework\TestCase;

class FormationTest extends TestCase
{
    private function getQuotationInstance($hasPlayed = true)
    {
        $quotation = $this->getMockBuilder('FFQP\Model\Quotation')
          ->setMethods(['hasPlayed', 'getSecondaryRole'])
          ->disableOriginalConstructor()
          ->getMock();
        $quotation->method('hasPlayed')->willReturn($hasPlayed);
        $quotation->method('getSecondaryRole')->willReturn('D');
        return $quotation;
    }

    private function getFootballerInstance($code, $hasPlayed = true)
    {
        $footballer = new class extends FootballerAbstract {};
        $footballer->setCode($code);

        $quotation = $this->getQuotationInstance($hasPlayed);
        $footballer->setQuotation($quotation);

        return $footballer;
    }

    private function getFootballerMock($code, $quotation)
    {
        $footballer = $this->getMockBuilder(FootballerAbstract::class)
          ->setMethods(['setQuotation', 'getCode'])
          ->disableOriginalConstructor()
          ->getMock();
        $footballer->method('getCode')->willReturn($code);
        $footballer->expects($this->once())->method('setQuotation')->with($quotation);
        return $footballer;
    }

    public function codeDataProvider()
    {
        return [
          [
            // First Strings
            [
              ['code' => '1', 'hasPlayed' => false],
              ['code' => '2', 'hasPlayed' => false],
              ['code' => '3', 'hasPlayed' => false],
              ['code' => '4', 'hasPlayed' => true],
            ],
            // Reserves
            [
              ['code' => '5', 'hasPlayed' => true],
              ['code' => '6', 'hasPlayed' => true],
            ],
            [5,6,4]
          ],
        ];
    }

    /**
     * @dataProvider codeDataProvider
     * @param array $firstStrings
     * @param array $reserves
     * @param array $expectedCodes
     */
    public function testGetWhoPlayed($firstStrings, $reserves, $expectedCodes)
    {
        $formation = new Formation();
        foreach ($firstStrings as $firstString) {
            $formation->addFirstString($this->getFootballerInstance($firstString['code'], $firstString['hasPlayed']));
        }
        foreach ($reserves as $reserve) {
            $formation->addReserve($this->getFootballerInstance($reserve['code'], $reserve['hasPlayed']));
        }

        $whoPlayed = $formation->getWhoPlayed();

        foreach ($expectedCodes as $index => $expectedCode) {
            $this->assertEquals($expectedCode, $whoPlayed[$index]->getCode());
        }
    }

    public function quotationsDataProvider()
    {
        return [
          [
            // First Strings
            [
              ['code' => 6],
              ['code' => 4],
            ],
            // Reserves
            [
              ['code' => 2],
              ['code' => 3],
            ]
          ],
        ];
    }

    /**
     * @dataProvider codeDataProvider
     * @param array $firstStrings
     * @param array $reserves
     */
    public function testSetQuotations($firstStrings, $reserves)
    {
        $formation = new Formation();
        $quotations = [];
        foreach ($firstStrings as $firstString) {
            $quotationInstance = $this->getQuotationInstance(true);
            $quotations[$firstString['code']] = $quotationInstance;
            $footballerInstance = $this->getFootballerMock($firstString['code'], $quotationInstance);
            $formation->addFirstString($footballerInstance);
        }
        foreach ($reserves as $reserve) {
            $quotationInstance = $this->getQuotationInstance(true);
            $quotations[$reserve['code']] = $quotationInstance;
            $footballerInstance = $this->getFootballerMock($reserve['code'], $quotationInstance);
            $formation->addReserve($footballerInstance);
        }
        $formation->setQuotations($quotations);
    }
}
