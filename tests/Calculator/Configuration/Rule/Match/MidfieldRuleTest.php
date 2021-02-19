<?php

namespace Test\Calculator\Configuration\Rule\Match;

use FFC\Calculator\Configuration\Rule\Match\MidfieldRule;
use FFC\Calculator\ConversionTable\MidfieldConversionTable;
use FFC\Formation\Footballer\FootballerAbstract;
use PHPUnit\Framework\TestCase;

class MidfieldRuleTest extends TestCase
{
    private function getFootballerInstance($role, $isWithoutVote, $vote)
    {
        $footballer = $this->getMockBuilder(FootballerAbstract::class)
          ->setMethods(['getQuotation'])
          ->disableOriginalConstructor()
          ->getMock();
        $footballer->method('getQuotation')->willReturn(
          $this->getQuotationInstance($role, $isWithoutVote, $vote)
        );
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
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 6.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 6.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 6.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 6.0],
            ],
            [
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 7.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 7.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 7.0],
            ],
            0
          ],
          [
            [
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 7.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 7.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 7.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 7.0],
            ],
            [
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 6.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 6.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 6.0],
            ],
            0.5
          ],
          [
            [
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 6.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 6.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 6.0],
            ],
            [
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 7.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 7.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 7.0],
              ['role' => 'C', 'isWithoutVote' => true, 'vote' => 7.0],
            ],
            -0.5
          ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param array $quotations
     * @param float $expectedBonus
     */
    public function testGetBonus($quotations, $opponentsQuotations, $expectedBonus)
    {
        $rule = new MidfieldRule(new MidfieldConversionTable());
        $footballers = [];
        foreach ($quotations as $quotation) {
            $footballers[] = $this->getFootballerInstance(
              $quotation['role'],
              $quotation['isWithoutVote'],
              $quotation['vote']
            );
        }

        $opponents = [];
        foreach ($opponentsQuotations as $quotation) {
            $opponents[] = $this->getFootballerInstance(
              $quotation['role'],
              $quotation['isWithoutVote'],
              $quotation['vote']
            );
        }

        $this->assertEquals($expectedBonus, $rule->getBonus($footballers, $opponents));
    }
}
