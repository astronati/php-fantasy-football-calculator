<?php

namespace FFC\Calculator;

use FFC\Calculator\Result\MatchResult;
use FFC\Calculator\Result\Result;
use FFC\Formation\Formation;

interface CalculatorInterface
{
    /**
     * @param Formation $formation
     * @return Result
     */
    public function getSingleResult(Formation $formation): Result;

    /**
     * @param Formation $homeFormation
     * @param Formation $awayFormation
     * @return MatchResult
     */
    public function getMatchResult(Formation $homeFormation, Formation $awayFormation): MatchResult;
}
