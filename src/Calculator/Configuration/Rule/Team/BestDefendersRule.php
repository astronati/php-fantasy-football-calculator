<?php

namespace FFC\Calculator\Configuration\Rule\Team;

use FFC\Calculator\Configuration\Rule\TeamRuleAbstract;

class BestDefendersRule extends TeamRuleAbstract
{
    public function getBonus($footballers): float
    {
        return 0;
        // TODO: Implement getBonus() method.
        // TODO

//        if (count($defenderVotes) >= 4) {
//            // Orders from the highest value to the lowest one
//            rsort($defenderVotes);
//            // Takes three footballers with the highest vote and sum them
//            $threeBestDefendersVotes = array_slice($defenderVotes, 0, 3);
//            // Sums the goalkeeper and defenders votes and divide the result by 4 (the number of footballers)
//            $average = ($config['goalkeeper'] + array_sum($threeBestDefendersVotes)) / 4;
//
//            return $this->_conversionTable->getConvertedValue($average);
//        }
//        return 0;
    }
}
