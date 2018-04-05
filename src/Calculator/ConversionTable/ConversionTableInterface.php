<?php

namespace FFC\Calculator\ConversionTable;

interface ConversionTableInterface
{
    /**
     * Returns the bonus/malus associated to the given value.
     * @param float|int $value
     * @return float|int
     */
    public function convert($value);
}
