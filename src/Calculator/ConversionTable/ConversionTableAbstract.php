<?php

namespace FFC\Calculator\ConversionTable;

use FFC\Calculator\ConversionTable\Row\ConversionTableRow;

abstract class ConversionTableAbstract implements ConversionTableInterface
{
    /**
     * @var ConversionTableRow[]
     */
    protected $table = array();

    /**
     * @inheritdoc
     */
    public function convert($value)
    {
        foreach ($this->table as $row) {
            if ($value >= $row->getValue()) {
                return $row->getConvertedValue();
            }
        }
        return 0;
    }
}
