<?php

namespace FFC\Calculator\Configuration\Rule\Team;

use FFC\Calculator\Configuration\Rule\TeamRuleAbstract;

class GoalBonusSince2017Rule extends TeamRuleAbstract
{
    const DEFAULT_GOAL_BONUS = 3;

    /**
     * Calculates the difference of the goals bonus and return it.
     * @inheritdoc
     */
    public function getBonus($footballers): float
    {
        $bonus = 0;
        foreach ($footballers as $footballer) {
            $goals = $footballer->getQuotation()->getGoals();
            $bonusPerGoal = $this->conversionTable->convert($footballer->getQuotation()->getRole());
            $bonus += ($bonusPerGoal - self::DEFAULT_GOAL_BONUS) * $goals;
        }
        return $bonus;
    }
}
