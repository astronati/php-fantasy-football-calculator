<?php

namespace Test\Calculator\Result;

use FFC\Calculator\Result\Result;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    public function dataProvider()
    {
        return [
          [6.5, 2],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param float $magicPoints
     * @param float $bonus
     */
    public function testGetBonus($magicPoints, $bonus)
    {
        $result = new Result($magicPoints, $bonus);
        $this->assertEquals($bonus, $result->getBonus());
    }

    /**
     * @dataProvider dataProvider
     * @param float $magicPoints
     * @param float $bonus
     */
    public function testGetMagicPoints($magicPoints, $bonus)
    {
        $result = new Result($magicPoints, $bonus);
        $this->assertEquals($magicPoints, $result->getMagicPoints());
    }
}
