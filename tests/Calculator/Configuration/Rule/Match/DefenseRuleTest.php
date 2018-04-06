<?php

namespace Test\Calculator\Configuration\Rule\Match;

use FFC\Calculator\Configuration\Rule\Match\DefenseRule;
use FFC\Calculator\ConversionTable\DefenseConversionTable;
use FFC\Formation\Footballer\FootballerAbstract;
use PHPUnit\Framework\TestCase;

class DefenseRuleTest extends TestCase
{
    private function getFootballerInstance($role, $isWithoutVote, $vote)
    {
        $footballer = $this->getMockBuilder(FootballerAbstract::class)
          ->setMethods(['getQuotation'])
          ->disableOriginalConstructor()
          ->getMock();
        $footballer->method('getQuotation')->willReturn($this->getQuotationInstance($role, $isWithoutVote, $vote));
        return $footballer;
    }

    private function getQuotationInstance($role, $isWithoutVote, $vote)
    {
        $quotation = $this->getMockBuilder('FFQP\Model\Quotation')
          ->setMethods(['getSecondaryRole', 'isWithoutVote', 'getOriginalMagicPoints', 'getVote'])
          ->disableOriginalConstructor()
          ->getMock();
        $quotation->method('getSecondaryRole')->willReturn($role);
        $quotation->method('isWithoutVote')->willReturn($isWithoutVote);
        $quotation->method('getOriginalMagicPoints')->willReturn($vote);
        $quotation->method('getVote')->willReturn($vote);
        return $quotation;
    }

    public function dataProvider()
    {
        return [
          [
            [
              ['role' => 'P', 'isWithoutVote' => true, 'vote' => 6],
              ['role' => 'D', 'isWithoutVote' => true, 'vote' => 6],
              ['role' => 'D', 'isWithoutVote' => true, 'vote' => 6.5],
              ['role' => 'D', 'isWithoutVote' => true, 'vote' => 6.5],
              ['role' => 'D', 'isWithoutVote' => false, 'vote' => 6],
              ['role' => 'D', 'isWithoutVote' => true, 'vote' => 7],
            ],
            -3
          ],
          [
            [
              ['role' => 'D', 'isWithoutVote' => true, 'vote' => 7],
              ['role' => 'D', 'isWithoutVote' => true, 'vote' => 7],
              ['role' => 'D', 'isWithoutVote' => true, 'vote' => 7],
            ],
            -4
          ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param array $quotations
     * @param float $expectedBonus
     */
    public function testGetBonus($quotations, $expectedBonus)
    {
        $rule = new DefenseRule(new DefenseConversionTable());
        $footballers = [];
        foreach ($quotations as $quotation) {
            $footballers[] = $this->getFootballerInstance(
              $quotation['role'],
              $quotation['isWithoutVote'],
              $quotation['vote']
            );
        }
        $this->assertEquals($expectedBonus, $rule->getBonus(array(), $footballers));
    }
}
