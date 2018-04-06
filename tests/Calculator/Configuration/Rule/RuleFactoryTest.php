<?php

namespace Test\Calculator\Configuration\Rule;

use FFC\Calculator\Configuration\Rule\Match\DefenseRule;
use FFC\Calculator\Configuration\Rule\Match\HomeRule;
use FFC\Calculator\Configuration\Rule\Match\MidfieldRule;
use FFC\Calculator\Configuration\Rule\RuleFactory;
use FFC\Calculator\Configuration\Rule\Team\BestDefendersRule;
use FFC\Calculator\Configuration\Rule\Team\ForwardRule;
use FFC\Calculator\Configuration\Rule\Team\GoalBonusSince2017Rule;
use PHPUnit\Framework\TestCase;

class RuleFactoryTest extends TestCase
{
    public function dataProvider()
    {
        return [
          [1, BestDefendersRule::class],
          [2, DefenseRule::class],
          [3, ForwardRule::class],
          [4, GoalBonusSince2017Rule::class],
          [5, HomeRule::class],
          [6, MidfieldRule::class],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param int $type
     * @param string $expectedClass
     */
    public function testCreate($type, $expectedClass)
    {
        $this->assertSame($expectedClass, get_class(RuleFactory::create($type)));
    }

    public function testException()
    {
        $this->expectException(\Exception::class);
        RuleFactory::create(7);
    }
}
