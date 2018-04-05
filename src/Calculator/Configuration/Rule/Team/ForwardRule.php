<?php

namespace FFC\Calculator\Configuration\Rule\Team;

use FFC\Calculator\Configuration\Rule\TeamRuleAbstract;
use FFQP\Map\Row\Row;

class ForwardRule extends TeamRuleAbstract
{
    /**
     * Bonus can be added to all those forwards that did not score but own vote is higher than 6.
     * NOTE: bonus is applied if footballer didn't score and missed a penalty.
     * @inheritdoc
     */
    public function getBonus($footballers): float
    {
        $bonus = 0;
        foreach ($footballers as $footballer) {
            $footballerQuotation = $footballer->getQuotation();
            if ($footballerQuotation->getSecondaryRole() === Row::FORWARD
                    && $footballerQuotation->getGoals() === 0) {
                $bonus += $this->conversionTable->convert($footballerQuotation->getVote());
            }
        }
        return $bonus;
    }
}
