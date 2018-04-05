<?php

namespace FFC\Calculator\Configuration\Rule;

use FFC\Formation\Footballer\FootballerAbstract;

abstract class TeamRuleAbstract extends RuleAbstract
{
    /**
     * @param FootballerAbstract[] $footballers
     * @return float
     */
    abstract public function getBonus($footballers): float;
}