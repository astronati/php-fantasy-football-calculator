<?php

namespace FFC\Calculator\Configuration\Rule\Match;

use FFC\Calculator\Configuration\Rule\MatchRuleAbstract;

class HomeRule extends MatchRuleAbstract
{
    public function getBonus($footballers, $opponents): float
    {
        return 0;
        // TODO: Implement getBonus() method.
    }
}
