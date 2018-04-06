<?php

namespace FFC\Calculator\Configuration\Rule\Match;

use FFC\Calculator\Configuration\Rule\MatchRuleAbstract;

class HomeRule extends MatchRuleAbstract
{
    /**
     * @inheritdoc
     */
    public function getBonus(array $footballers = [], array $opponents = []): float
    {
        return 2;
    }
}
