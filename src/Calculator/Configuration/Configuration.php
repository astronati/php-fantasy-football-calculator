<?php

namespace FFC\Calculator\Configuration;

use FFC\Calculator\Configuration\Rule\RuleAbstract;

class Configuration
{
    /**
     * @var RuleAbstract[]
     */
    private $rules = array();

    /**
     * @param RuleAbstract $rule
     */
    public function addRule(RuleAbstract $rule)
    {
        $this->rules[] = $rule;
        return $this;
    }

    /**
     * @return RuleAbstract[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }
}
