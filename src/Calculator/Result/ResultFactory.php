<?php

namespace FFC\Calculator\Result;

use FFC\Calculator\Configuration\Configuration;
use FFC\Calculator\Configuration\Rule\TeamRuleAbstract;
use FFC\Calculator\ConversionTable\GoalConversionTable;
use FFC\Formation\Footballer\FootballerAbstract;

class ResultFactory
{
    /**
     * @param FootballerAbstract[] $footballers
     * @param Configuration $configuration
     * @return Result
     */
    public function createResult(array $footballers, Configuration $configuration): Result
    {
        return new Result($this->extractMagicPoints($footballers), $this->extractBonus($footballers, $configuration));
    }

    /**
     * @param FootballerAbstract[] $homeFootballers
     * @param FootballerAbstract[] $awayFootballers
     * @param Configuration $configuration
     * @return MatchResult
     */
    public function createMatchResult(array $homeFootballers, array $awayFootballers, Configuration $configuration): MatchResult
    {
        return new MatchResult(
          new Result(
            $this->extractMagicPoints($homeFootballers),
            // TODO Adjust match bonus
            $this->extractBonus($homeFootballers, $configuration) + $this->extractMatchBonus($homeFootballers, $awayFootballers, true, $configuration)
          ),
          new Result(
            $this->extractMagicPoints($awayFootballers),// TODO Adjust match bonus
            $this->extractBonus($awayFootballers, $configuration) + $this->extractMatchBonus($awayFootballers, $homeFootballers, false, $configuration)
          ),
          new GoalConversionTable()
        );
    }

    /**
     * @param FootballerAbstract[] $footballers
     * @return float
     */
    private function extractMagicPoints(array $footballers): float
    {
        $magicPoints = 0;
        foreach ($footballers as $footballer) {
            $magicPoints += $footballer->getQuotation()->getOriginalMagicPoints();
        }
        return $magicPoints;
    }

    /**
     * @param FootballerAbstract[] $footballers
     * @param Configuration $configuration
     * @return float
     */
    private function extractBonus(array $footballers, Configuration $configuration): float
    {
        $bonus = 0;
        foreach ($configuration->getRules() as $rule) {
            if ($rule instanceof TeamRuleAbstract)
            $bonus += $rule->getBonus($footballers);
        }
        return $bonus;
    }

    /**
     * @param FootballerAbstract[] $footballers
     * @param FootballerAbstract[] $opponents
     * @param bool $isHome
     * @param Configuration $configuration
     * @return float
     */
    // TODO Remove boolean with something else
    private function extractMatchBonus(array $footballers, array $opponents, bool $isHome = false, Configuration $configuration): float
    {
        $bonus = 0;
//        foreach ($configuration->getRules() as $rule) {
//            if ($rule instanceof MatchRuleAbstract)
//                $bonus += $rule->getBonus($footballers);
//        }
        return $bonus;
    }
}
