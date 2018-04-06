<?php

namespace Test\Calculator\Configuration\Rule\Match;

use FFC\Calculator\Configuration\Rule\Match\HomeRule;
use PHPUnit\Framework\TestCase;

class HomeRuleTest extends TestCase
{
    public function testGetBonus()
    {
        $rule = new HomeRule();
        $this->assertEquals(2, $rule->getBonus());
    }
}
