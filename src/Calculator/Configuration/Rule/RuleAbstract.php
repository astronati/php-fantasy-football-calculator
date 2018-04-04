<?php

namespace FFC\Calculator\Configuration\Rule;

use FFC\Calculator\ConversionTable\ConversionTableAbstract;

abstract class RuleAbstract
{
    /**
     * @var ConversionTableAbstract
     */
    protected $conversionTable;

    public function __construct(ConversionTableAbstract $conversionTableAbstract = null)
    {
        $this->conversionTable = $conversionTableAbstract;
    }
}
