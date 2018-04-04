<?php

namespace FFC\Formation\Footballer;

use FFQP\Model\Quotation;

interface FootballerInterface
{
    /**
     * @return string
     */
    public function getCode(): string;

    /**
     * @param string $code
     */
    public function setCode(string $code);

    /**
     * @return bool
     */
    public function hasEnteredTheGame(): bool;

    /**
     * Marks footballer as entered the game.
     */
    public function enterTheGame();

    /**
     * @return Quotation
     */
    public function getQuotation(): Quotation;

    /**
     * @param Quotation $quotation
     */
    public function setQuotation(Quotation $quotation);
}
