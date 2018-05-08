<?php

namespace FFC\Calculator\Configuration\Rule;

use FFC\Calculator\Configuration\Rule\Match\DefenseRule;
use FFC\Calculator\Configuration\Rule\Match\HomeRule;
use FFC\Calculator\Configuration\Rule\Match\MidfieldRule;
use FFC\Calculator\Configuration\Rule\Team\BestDefendersRule;
use FFC\Calculator\Configuration\Rule\Team\ForwardRule;
use FFC\Calculator\Configuration\Rule\Team\GoalBonusSince2017Rule;
use FFC\Calculator\ConversionTable\BestDefendersConversionTable;
use FFC\Calculator\ConversionTable\DefenseConversionTable;
use FFC\Calculator\ConversionTable\ForwardConversionTable;
use FFC\Calculator\ConversionTable\GoalBonusSince2017ConversionTable;
use FFC\Calculator\ConversionTable\MidfieldConversionTable;
use FFC\Exception\NotFoundRuleTypeException;

class RuleFactory
{
    const BEST_DEFENDERS_RULE = 1;
    const DEFENSE_RULE = 2;
    const FORWARD_RULE = 3;
    const GOAL_BONUS_SINCE_2017_RULE = 4;
    const HOME_RULE = 5;
    const MIDFIELD_RULE = 6;

    /**
     * @param int $type
     * @return RuleAbstract
     * @throws NotFoundRuleTypeException
     */
    public static function create($type): RuleAbstract
    {
        switch ($type) {
            case self::BEST_DEFENDERS_RULE:
                return new BestDefendersRule(new BestDefendersConversionTable());
            case self::DEFENSE_RULE:
                return new DefenseRule(new DefenseConversionTable());
            case self::FORWARD_RULE:
                return new ForwardRule(new ForwardConversionTable());
            case self::GOAL_BONUS_SINCE_2017_RULE:
                return new GoalBonusSince2017Rule(new GoalBonusSince2017ConversionTable());
            case self::HOME_RULE:
                return new HomeRule();
            case self::MIDFIELD_RULE:
                return new MidfieldRule(new MidfieldConversionTable());
            default:
                throw new NotFoundRuleTypeException('Rule not found: ' . $type);
        }
    }
}
