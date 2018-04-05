<?php

namespace FFC\Calculator\Configuration\Rule\Team;

use FFC\Calculator\Configuration\Rule\TeamRuleAbstract;
use FFQP\Map\Row\Row;

class BestDefendersRule extends TeamRuleAbstract
{
    /**
     * The bonus is added to the given formation based on the vote of the goalkeeper and the ones of the 3 (three) best
     * defenders.
     * @inheritdoc
     */
    public function getBonus($footballers): float
    {
        $defendersVotes = $this->getVotesByRole($footballers, Row::DEFENDER);

        if (count($defendersVotes) >= 4) {
            // Orders from the highest value to the lowest one
            rsort($defendersVotes);
            // Takes three footballers with the highest vote and sum them
            $threeBestDefendersVotes = array_slice($defendersVotes, 0, 3);
            $goalkeeperVote = $this->getVotesByRole($footballers, Row::GOALKEEPER);
            // Sums the goalkeeper and defenders votes and divide the result by 4 (the number of footballers)
            $average = $this->getVotesAverage(array_merge($threeBestDefendersVotes, $goalkeeperVote));
            return $this->conversionTable->convert($average);
        }

        return 0;
    }
}
