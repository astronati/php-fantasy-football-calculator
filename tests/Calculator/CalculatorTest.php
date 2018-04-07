<?php

namespace Test\Calculator;

use FFC\Calculator\Calculator;
use FFC\Calculator\Configuration\Configuration;
use FFC\Calculator\Configuration\Rule\RuleFactory;
use FFC\Formation\Footballer\FootballerAbstract;
use FFC\Formation\Formation;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private function getQuotationInstance($code, $magicPoints, $role)
    {
        $quotation = $this->getMockBuilder('FFQP\Model\Quotation')
          ->setMethods(['getCode', 'getMagicPoints', 'getSecondaryRole', 'getOriginalMagicPoints'])
          ->disableOriginalConstructor()
          ->getMock();
        $quotation->method('getCode')->willReturn($code);
        $quotation->method('getMagicPoints')->willReturn($magicPoints);
        $quotation->method('getOriginalMagicPoints')->willReturn($magicPoints);
        $quotation->method('getSecondaryRole')->willReturn($role);
        return $quotation;
    }

    private function getFootballerInstance($code)
    {
        $footballer = $this->getMockBuilder(FootballerAbstract::class)
          ->setMethods(['getCode'])
          ->disableOriginalConstructor()
          ->getMock();
        $footballer->method('getCode')->willReturn($code);
        return $footballer;
    }

    public function dataProvider()
    {
        return [
          [
            [
              ['code' => 1, 'role' => 'P', 'magicPoints' => 6],
              ['code' => 2, 'role' => 'D', 'magicPoints' => 6],
              ['code' => 3, 'role' => 'D', 'magicPoints' => 6],
              ['code' => 4, 'role' => 'D', 'magicPoints' => 6],
              ['code' => 5, 'role' => 'D', 'magicPoints' => 6],
              ['code' => 6, 'role' => 'C', 'magicPoints' => 6],
              ['code' => 7, 'role' => 'C', 'magicPoints' => 6],
              ['code' => 8, 'role' => 'C', 'magicPoints' => 6],
              ['code' => 9, 'role' => 'A', 'magicPoints' => 6],
              ['code' => 10, 'role' => 'A', 'magicPoints' => 6],
              ['code' => 11, 'role' => 'A', 'magicPoints' => 6],
            ],
            [
              ['code' => 1],
              ['code' => 2],
              ['code' => 3],
              ['code' => 4],
              ['code' => 5],
              ['code' => 6],
              ['code' => 7],
              ['code' => 8],
              ['code' => 9],
              ['code' => 10],
              ['code' => 11],
            ],
            66,
            1,
          ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param array $quotationsData
     * @param array $footballers
     * @param float $expectedMagicPoints
     * @param float $expectedBonus
     */
    public function testGetSingleResult($quotationsData, $footballers, $expectedMagicPoints, $expectedBonus)
    {
        $configuration = new Configuration();
        $configuration->addRule(RuleFactory::create(RuleFactory::BEST_DEFENDERS_RULE));

        $quotations = [];
        foreach ($quotationsData as $quotationData) {
            $quotations[] = $this->getQuotationInstance($quotationData['code'], $quotationData['magicPoints'], $quotationData['role']);
        }
        $calculator = new Calculator($quotations, $configuration);

        $formation = new Formation();
        foreach ($footballers as $footballer) {
            $formation->addFirstString($this->getFootballerInstance($footballer['code']));
        }
        $result = $calculator->getSingleResult($formation);

        $this->assertEquals($expectedMagicPoints, $result->getMagicPoints());
        $this->assertEquals($expectedBonus, $result->getBonus());
    }
}
