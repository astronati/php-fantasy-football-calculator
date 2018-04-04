<?php

namespace FFC\Calculator\ConversionTable;

class ConversionTableRow
{
    /**
     * @var float|int
     */
    private $value;

    /**
     * @var float|int
     */
    private $convertedValue;

    public function __construct($value, $convertedValue)
    {
        $this->value = $value;
        $this->convertedValue = $convertedValue;
    }

    /**
     * @return float|int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return float|int
     */
    public function getConvertedValue()
    {
        return $this->convertedValue;
    }
}