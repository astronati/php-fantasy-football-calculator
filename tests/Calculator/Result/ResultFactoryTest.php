<?php

namespace Test\Calculator\Result;

use FFC\Calculator\Configuration\Configuration;
use FFC\Calculator\Configuration\Rule\RuleFactory;
use FFC\Calculator\Result\ResultFactory;
use FFC\Formation\Footballer\FootballerAbstract;
use PHPUnit\Framework\TestCase;

class ResultFactoryTest extends TestCase
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
              ['role' => 'P', 'magicPoints' => 6.0],
              ['role' => 'D', 'magicPoints' => 6.0],
              ['role' => 'D', 'magicPoints' => 6.0],
              ['role' => 'D', 'magicPoints' => 6.0],
              ['role' => 'D', 'magicPoints' => 6.0],
              ['role' => 'C', 'magicPoints' => 6.0],
              ['role' => 'C', 'magicPoints' => 6.0],
              ['role' => 'C', 'magicPoints' => 6.0],
              ['role' => 'A', 'magicPoints' => 6.0],
              ['role' => 'A', 'magicPoints' => 6.0],
              ['role' => 'A', 'magicPoints' => 6.0],
            ],
            66.0,
            1.0
          ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param array $quotations
     * @paarm float $expectedMagicPoints
     * @param float $expectedBonus
     */
    public function testCreateResult($quotations, $expectedMagicPoints, $expectedBonus)
    {
        $resultFactory = new ResultFactory();
        $footballers = [];
        foreach ($quotations as $quotation) {
            $footballers[] = $this->getFootballerInstance($quotation['role'], false, $quotation['magicPoints']);
        }
        $configuration = new Configuration();
        $configuration->addRule(RuleFactory::create(RuleFactory::BEST_DEFENDERS_RULE));
        $result = $resultFactory->createResult($footballers, $configuration);

        $this->assertEquals($expectedMagicPoints, $result->getMagicPoints());
        $this->assertEquals($expectedBonus, $result->getBonus());
    }

    public function matchDataProvider()
    {
        return [
          [
            [
              ['role' => 'P', 'magicPoints' => 6.0],
              ['role' => 'D', 'magicPoints' => 6.0],
              ['role' => 'D', 'magicPoints' => 6.0],
              ['role' => 'D', 'magicPoints' => 6.0],
              ['role' => 'D', 'magicPoints' => 6.0],
              ['role' => 'C', 'magicPoints' => 6.0],
              ['role' => 'C', 'magicPoints' => 6.0],
              ['role' => 'C', 'magicPoints' => 6.0],
              ['role' => 'A', 'magicPoints' => 6.0],
              ['role' => 'A', 'magicPoints' => 6.0],
              ['role' => 'A', 'magicPoints' => 6.0],
            ],
            [
              ['role' => 'P', 'magicPoints' => 7.0],
              ['role' => 'D', 'magicPoints' => 7.0],
              ['role' => 'D', 'magicPoints' => 7.0],
              ['role' => 'D', 'magicPoints' => 7.0],
              ['role' => 'D', 'magicPoints' => 6.0],
              ['role' => 'C', 'magicPoints' => 6.0],
              ['role' => 'C', 'magicPoints' => 6.0],
              ['role' => 'C', 'magicPoints' => 6.0],
              ['role' => 'A', 'magicPoints' => 6.0],
              ['role' => 'A', 'magicPoints' => 6.0],
              ['role' => 'A', 'magicPoints' => 6.0],
            ],
            66,
            3,
            1,
            70,
            6,
            2
          ],
        ];
    }

    /**
     * @dataProvider matchDataProvider
     * @param array $quotations
     * @param array $opponentsQuotations
     * @param float $expectedHomeMagicPoints
     * @param float $expectedHomeBonus
     * @param float $expectedHomeGoals
     * @param float $expectedAwayMagicPoints
     * @param float $expectedAwayBonus
     * @param float $expectedAwayGoals
     */
    public function testCreateMatchResult(
      $quotations,
      $opponentsQuotations,
      $expectedHomeMagicPoints,
      $expectedHomeBonus,
      $expectedHomeGoals,
      $expectedAwayMagicPoints,
      $expectedAwayBonus,
      $expectedAwayGoals
    )
    {
        $resultFactory = new ResultFactory();
        $footballers = [];
        foreach ($quotations as $quotation) {
            $footballers[] = $this->getFootballerInstance($quotation['role'], false, $quotation['magicPoints']);
        }
        $opponents = [];
        foreach ($opponentsQuotations as $quotation) {
            $opponents[] = $this->getFootballerInstance($quotation['role'], false, $quotation['magicPoints']);
        }

        $configuration = new Configuration();
        $configuration
          ->addRule(RuleFactory::create(RuleFactory::BEST_DEFENDERS_RULE))
          ->addRule(RuleFactory::create(RuleFactory::HOME_RULE))
        ;
        $matchResult = $resultFactory->createMatchResult($footballers, $opponents, $configuration);

        $this->assertEquals($expectedHomeMagicPoints, $matchResult->getHomeResult()->getMagicPoints());
        $this->assertEquals($expectedHomeBonus, $matchResult->getHomeResult()->getBonus());
        $this->assertEquals($expectedHomeGoals, $matchResult->getHomeGoals());

        $this->assertEquals($expectedAwayMagicPoints, $matchResult->getAwayResult()->getMagicPoints());
        $this->assertEquals($expectedAwayBonus, $matchResult->getAwayResult()->getBonus());
        $this->assertEquals($expectedAwayGoals, $matchResult->getAwayGoals());
    }
}
