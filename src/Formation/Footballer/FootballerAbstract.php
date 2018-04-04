<?php

namespace FFC\Formation\Footballer;

use FFQP\Model\Quotation;

abstract class FootballerAbstract implements FootballerInterface
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var Quotation
     */
    private $quotation;

    /**
     * @var bool
     */
    private $hasEnteredTheGame = false;

    /**
     * @inheritdoc
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @inheritdoc
     */
    public function setCode(string $code) {
        $this->code = $code;
    }

    /**
     * @inheritdoc
     */
    public function getQuotation(): Quotation
    {
        return $this->quotation;
    }

    /**
     * @inheritdoc
     */
    public function setQuotation(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    /**
     * @inheritdoc
     */
    public function hasEnteredTheGame(): bool
    {
        return $this->hasEnteredTheGame === true;
    }

    /**
     * @inheritdoc
     */
    public function enterTheGame()
    {
        $this->hasEnteredTheGame = true;
    }
}
