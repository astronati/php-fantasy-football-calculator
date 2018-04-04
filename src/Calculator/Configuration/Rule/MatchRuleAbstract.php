<?php

namespace FFC\Calculator\Configuration\Rule;

use FFC\Formation\Footballer\FootballerAbstract;

abstract class MatchRuleAbstract extends RuleAbstract
{
    /**
     * @param FootballerAbstract[] $footballers
     * @param FootballerAbstract[] $opponents
     * @return float
     */
    abstract function getBonus($footballers, $opponents): float;
}
