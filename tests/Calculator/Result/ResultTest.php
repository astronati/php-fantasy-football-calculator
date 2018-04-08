<?php

namespace Test\Calculator\Result;

use FFC\Calculator\Result\Result;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    public function dataProvider()
    {
        return [
          [6.5, 2, 8.5],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param float $magicPoints
     * @param float $bonus
     * @param float $total
     */
    public function testGetBonus($magicPoints, $bonus, $total)
    {
        $result = new Result($magicPoints, $bonus);
        $this->assertEquals($bonus, $result->getBonus());
    }

    /**
     * @dataProvider dataProvider
     * @param float $magicPoints
     * @param float $bonus
     * @param float $total
     */
    public function testGetMagicPoints($magicPoints, $bonus, $total)
    {
        $result = new Result($magicPoints, $bonus);
        $this->assertEquals($magicPoints, $result->getMagicPoints());
    }

    /**
     * @dataProvider dataProvider
     * @param float $magicPoints
     * @param float $bonus
     * @param float $total
     */
    public function testGetTotal($magicPoints, $bonus, $total)
    {
        $result = new Result($magicPoints, $bonus);
        $this->assertEquals($total, $result->getTotal());
    }
}
