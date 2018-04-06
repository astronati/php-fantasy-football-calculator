<?php

namespace Test\Calculator\Configuration;

use FFC\Calculator\Configuration\Configuration;
use FFC\Calculator\Configuration\Rule\RuleAbstract;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    private function getRuleInstance()
    {
        $rule = $this->getMockBuilder(RuleAbstract::class)
          ->disableOriginalConstructor()
          ->getMock();
        return $rule;
    }

    public function dataProvider()
    {
        return [
          [3],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param int $iterator
     */
    public function testGetWhoPlayed($iterator)
    {
        $configuration = new Configuration();
        for ($i = 0; $i < $iterator; $i++) {
            $configuration->addRule($this->getRuleInstance());
        }

        $this->assertSame($iterator, count($configuration->getRules()));
    }
}
