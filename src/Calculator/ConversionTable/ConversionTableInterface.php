<?php

namespace FFC\Calculator\ConversionTable;

interface ConversionTableInterface
{
    /**
     * @param float|int $value
     * @return float|int
     */
    public function convert($value);
}
