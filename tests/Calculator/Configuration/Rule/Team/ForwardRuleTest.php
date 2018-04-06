<?php

namespace Test\Calculator\Configuration\Rule\Team;

use FFC\Calculator\Configuration\Rule\Team\ForwardRule;
use FFC\Calculator\ConversionTable\ForwardConversionTable;
use FFC\Formation\Footballer\FootballerAbstract;
use PHPUnit\Framework\TestCase;

class ForwardRuleTest extends TestCase
{
    private function getFootballerInstance($role, $isWithoutVote, $vote, $goals)
    {
        $footballer = $this->getMockBuilder(FootballerAbstract::class)
          ->setMethods(['getQuotation'])
          ->disableOriginalConstructor()
          ->getMock();
        $footballer->method('getQuotation')->willReturn($this->getQuotationInstance($role, $isWithoutVote, $vote, $goals));
        return $footballer;
    }

    private function getQuotationInstance($role, $isWithoutVote, $vote, $goals)
    {
        $quotation = $this->getMockBuilder('FFQP\Model\Quotation')
          ->setMethods(['getSecondaryRole', 'isWithoutVote', 'getOriginalMagicPoints', 'getVote', 'getGoals'])
          ->disableOriginalConstructor()
          ->getMock();
        $quotation->method('getSecondaryRole')->willReturn($role);
        $quotation->method('isWithoutVote')->willReturn($isWithoutVote);
        $quotation->method('getOriginalMagicPoints')->willReturn($vote);
        $quotation->method('getVote')->willReturn($vote);
        $quotation->method('getGoals')->willReturn($goals);
        return $quotation;
    }

    public function dataProvider()
    {
        return [
          [
            [
              ['role' => 'A', 'isWithoutVote' => true, 'vote' => 7, 'goals' => 1],
              ['role' => 'A', 'isWithoutVote' => true, 'vote' => 6, 'goals' => 1],
              ['role' => 'A', 'isWithoutVote' => true, 'vote' => 6.5, 'goals' => 1],
            ],
            0
          ],
          [
            [
              ['role' => 'A', 'isWithoutVote' => true, 'vote' => 8, 'goals' => 0],
              ['role' => 'A', 'isWithoutVote' => true, 'vote' => 6, 'goals' => 0],
              ['role' => 'A', 'isWithoutVote' => true, 'vote' => 7, 'goals' => 0],
            ],
            3
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
        $rule = new ForwardRule(new ForwardConversionTable());
        $footballers = [];
        foreach ($quotations as $quotation) {
            $footballers[] = $this->getFootballerInstance(
              $quotation['role'],
              $quotation['isWithoutVote'],
              $quotation['vote'],
              $quotation['goals']
            );
        }
        $this->assertEquals($expectedBonus, $rule->getBonus($footballers));
    }
}
