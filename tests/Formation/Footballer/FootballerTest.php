<?php

namespace Test\Formation\Footballer;

use FFC\Formation\Footballer\FootballerAbstract;
use PHPUnit\Framework\TestCase;

class FootballerTest extends TestCase
{
    /**
     * @var FootballerAbstract
     */
    private $footballerInstance;

    private function getQuotationInstance()
    {
        $quotation = $this->getMockBuilder('FFQP\Model\Quotation')
          ->disableOriginalConstructor()
          ->getMock();
        return $quotation;
    }

    public function setUp()
    {
        $this->footballerInstance = new class extends FootballerAbstract {};
    }

    public function codeDataProvider()
    {
        return [
          ['123'],
        ];
    }

    /**
     * @dataProvider codeDataProvider
     * @param string $code
     */
    public function testGetCode($code)
    {
        $this->footballerInstance->setCode($code);
        $this->assertEquals($code, $this->footballerInstance->getCode());
    }

    public function testHasEnteredTheGame()
    {
        $this->assertEquals(false, $this->footballerInstance->hasEnteredTheGame());
        $this->footballerInstance->enterTheGame();
        $this->assertEquals(true, $this->footballerInstance->hasEnteredTheGame());
    }

    public function testGetQuotation()
    {
        $quotation = $this->getQuotationInstance();
        $this->footballerInstance->setQuotation($quotation);
        $this->assertEquals($quotation, $this->footballerInstance->getQuotation());
    }
}
