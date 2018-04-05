<?php

namespace FFC\Calculator\Configuration\Rule;

use FFC\Formation\Footballer\FootballerAbstract;

abstract class MatchRuleAbstract extends RuleAbstract
{
    /**
     * @param FootballerAbstract[]|null $footballers
     * @param FootballerAbstract[]|null $opponents
     * @return float
     */
    abstract public function getBonus(array $footballers = null, array $opponents = null): float;
}
