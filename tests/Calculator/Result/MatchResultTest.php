<?php

namespace Test\Calculator\Result;

use FFC\Calculator\ConversionTable\GoalConversionTable;
use FFC\Calculator\Result\MatchResult;
use FFC\Calculator\Result\Result;
use PHPUnit\Framework\TestCase;

class MatchResultTest extends TestCase
{
    public function dataProvider()
    {
        return [
          [
            ['magicPoints' => 66, 'bonus' => 2, 'goal' => 1],
            ['magicPoints' => 71, 'bonus' => 1, 'goal' => 2]
          ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param array $homeResult
     * @param array $awayResult
     */
    public function testGetHomeResult($homeResult, $awayResult)
    {
        $matchResult = new MatchResult(
          new Result($homeResult['magicPoints'], $homeResult['bonus']),
          new Result($awayResult['magicPoints'], $awayResult['bonus']),
          new GoalConversionTable()
        );
        $this->assertEquals($homeResult['magicPoints'], $matchResult->getHomeResult()->getMagicPoints());
        $this->assertEquals($homeResult['bonus'], $matchResult->getHomeResult()->getBonus());
    }

    /**
     * @dataProvider dataProvider
     * @param array $homeResult
     * @param array $awayResult
     */
    public function testGetHomeGoals($homeResult, $awayResult)
    {
        $matchResult = new MatchResult(
          new Result($homeResult['magicPoints'], $homeResult['bonus']),
          new Result($awayResult['magicPoints'], $awayResult['bonus']),
          new GoalConversionTable()
        );
        $this->assertEquals($homeResult['goal'], $matchResult->getHomeGoals());
    }

    /**
     * @dataProvider dataProvider
     * @param array $homeResult
     * @param array $awayResult
     */
    public function testGetAwayResult($homeResult, $awayResult)
    {
        $matchResult = new MatchResult(
          new Result($homeResult['magicPoints'], $homeResult['bonus']),
          new Result($awayResult['magicPoints'], $awayResult['bonus']),
          new GoalConversionTable()
        );
        $this->assertEquals($awayResult['magicPoints'], $matchResult->getAwayResult()->getMagicPoints());
        $this->assertEquals($awayResult['bonus'], $matchResult->getAwayResult()->getBonus());
    }

    /**
     * @dataProvider dataProvider
     * @param array $homeResult
     * @param array $awayResult
     */
    public function testGetAwayGoals($homeResult, $awayResult)
    {
        $matchResult = new MatchResult(
          new Result($homeResult['magicPoints'], $homeResult['bonus']),
          new Result($awayResult['magicPoints'], $awayResult['bonus']),
          new GoalConversionTable()
        );
        $this->assertEquals($awayResult['goal'], $matchResult->getAwayGoals());
    }
}
