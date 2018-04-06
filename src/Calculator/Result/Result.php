<?php

namespace FFC\Calculator\Result;

class Result implements ResultInterface
{
    /**
     * @var float
     */
    private $magicPoints;

    /**
     * @var float
     */
    private $bonus;

    public function __construct($magicPoints, $bonus)
    {
        $this->magicPoints = $magicPoints;
        $this->bonus = $bonus;
    }

    /**
     * @inheritdoc
     */
    public function getMagicPoints(): float
    {
        return $this->magicPoints;
    }

    /**
     * @inheritdoc
     */
    public function getBonus(): float
    {
        return $this->bonus;
    }
}
