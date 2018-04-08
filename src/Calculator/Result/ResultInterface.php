<?php

namespace FFC\Calculator\Result;

interface ResultInterface
{
    /**
     * @return float
     */
    public function getMagicPoints(): float;

    /**
     * @return float
     */
    public function getBonus(): float;

    /**
     * @return flaot
     */
    public function getTotal(): float;
}
