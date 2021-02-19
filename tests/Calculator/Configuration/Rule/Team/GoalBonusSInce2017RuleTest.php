<?php

namespace Test\Calculator\Configuration\Rule\Team;

use FFC\Calculator\Configuration\Rule\Team\GoalBonusSince2017Rule;
use FFC\Calculator\ConversionTable\GoalBonusSince2017ConversionTable;
use FFC\Formation\Footballer\FootballerAbstract;
use PHPUnit\Framework\TestCase;

class GoalBonusSInce2017RuleTest extends TestCase
{
    private function getFootballerInstance($role, $isWithoutVote, $vote, $goals)
    {
        $footballer = $this->getMockBuilder(FootballerAbstract::class)
          ->setMethods(['getQuotation'])
          ->disableOriginalConstructor()
          ->getMock();
        $footballer->method('getQuotation')->willReturn(
          $this->getQuotationInstance($role, $isWithoutVote, $vote, $goals)
        );
        return $footballer;
    }

    private function getQuotationInstance($role, $isWithoutVote, $vote, $goals)
    {
        $quotation = $this->getMockBuilder('FFQP\Model\Quotation')
          ->setMethods(['getRole', 'isWithoutVote', 'getOriginalMagicPoints', 'getVote', 'getGoals'])
          ->disableOriginalConstructor()
          ->getMock();
        $quotation->method('getRole')->willReturn($role);
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
              ['role' => 'A', 'isWithoutVote' => true, 'vote' => 7.0, 'goals' => 1],
              ['role' => 'D', 'isWithoutVote' => true, 'vote' => 6.0, 'goals' => 1],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 6.5, 'goals' => 1],
            ],
            2.5
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
        $rule = new GoalBonusSince2017Rule(new GoalBonusSince2017ConversionTable());
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
