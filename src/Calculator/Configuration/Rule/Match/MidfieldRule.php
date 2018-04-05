<?php

namespace FFC\Calculator\Configuration\Rule\Match;

use FFC\Calculator\Configuration\Rule\MatchRuleAbstract;
use FFQP\Map\Row\Row;

class MidfieldRule extends MatchRuleAbstract
{
    const RESERVE_VOTE = 5;

    /**
     * The bonus is applied to the better team, and the malus to the other team.
     * NOTE: This method applies only the bonus/malus to the given footballers, not to the opponents one.
     * @inheritdoc
     */
    public function getBonus(array $footballers = null, array $opponents = null): float
    {
        $midfielders = $this->getVotesByRole($footballers, Row::MIDFIELDER);
        $opponentsMidfielders = $this->getVotesByRole($opponents, Row::MIDFIELDER);

        // Determines the difference of the numbers of footballers.
        $difference = abs(count($midfielders) - count($opponentsMidfielders));

        if (count($midfielders) > count($opponentsMidfielders)) {
            $opponentsMidfielders = $this->indemnify($opponentsMidfielders, $difference);
        }

        if (count($opponentsMidfielders) > count($midfielders)) {
            $midfielders = $this->indemnify($midfielders, $difference);
        }

        $averageDifference = $this->getVotesAverage($midfielders) - $this->getVotesAverage($opponentsMidfielders);
        $bonus = $this->conversionTable->convert(abs($averageDifference));

        return $averageDifference < 0 ? -1 * $bonus : $bonus;
    }

    /**
     * Adds reserve votes in order to obtain two groups of votes with the same number.
     * @param float[] $midfielders
     * @param integer $increment
     * @return float[]
     */
    private function indemnify(array $midfielders, int $increment = 0): array
    {
        for ($i = 0; $i < $increment; $i++) {
            array_push($midfielders, self::RESERVE_VOTE);
        }
        return $midfielders;
    }
}
