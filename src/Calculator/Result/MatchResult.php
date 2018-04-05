<?php

namespace FFC\Calculator\Result;

use FFC\Calculator\ConversionTable\GoalConversionTable;

class MatchResult
{
    /**
     * @var Result
     */
    private $homeResult;

    /**
     * @var Result
     */
    private $awayResult;

    /**
     * @var GoalConversionTable
     */
    private $goalConversionTable;

    public function __construct(Result $homeResult, Result $awayResult, GoalConversionTable $goalConversionTable)
    {
        $this->homeResult = $homeResult;
        $this->awayResult = $awayResult;
        $this->goalConversionTable = $goalConversionTable;
    }

    /**
     * @return Result
     */
    public function getHomeResult(): Result
    {
        return $this->homeResult;
    }

    /**
     * @return int
     */
    public function getHomeGoals(): int
    {
        $result = $this->getHomeResult();
        return $this->goalConversionTable->convert($result->getMagicPoints() + $result->getBonus());
    }

    /**
     * @return Result
     */
    public function getAwayResult(): Result
    {
        return $this->awayResult;
    }

    /**
     * @return int
     */
    public function getAwayGoals(): int
    {
        $result = $this->getAwayResult();
        return $this->goalConversionTable->convert($result->getMagicPoints() + $result->getBonus());
    }
}
