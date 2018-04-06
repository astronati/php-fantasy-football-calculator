<?php

namespace FFC\Calculator\Configuration\Rule\Match;

use FFC\Calculator\Configuration\Rule\MatchRuleAbstract;
use FFQP\Map\Row\Row;

class DefenseRule extends MatchRuleAbstract
{
    /**
     * The bonus returned is actually a malus (in the most of the times) to apply according to the opponents defense
     * vote average.
     * @inheritdoc
     */
    public function getBonus(array $footballers = array(), array $opponents = array()): float
    {
        $defendersVotes = $this->getVotesByRole($opponents, Row::DEFENDER);

        $malus = $this->conversionTable->convert($this->getVotesAverage($defendersVotes));
        // If the defense is composed with a number of footballers different from 4, then the malus can be changed.
        // Malus is increased if the defense has more than 4 footballers.
        // Malus is decreased if the defense has 3 footballers.
        // The points to add/remove to the malus is given by the difference between the number of defenders and 4.
        return $malus - (count($defendersVotes) - 4);
    }
}
