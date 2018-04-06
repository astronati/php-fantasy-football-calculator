<?php

namespace FFC\Calculator\ConversionTable;

use FFC\Calculator\ConversionTable\Row\ConversionTableRow;

abstract class ConversionTableAbstract implements ConversionTableInterface
{
    /**
     * @var ConversionTableRow[]
     */
    protected $table = [];

    /**
     * @inheritdoc
     */
    public function convert($value)
    {
        foreach ($this->table as $row) {
            switch (gettype($row->getValue())) {
                case 'string':
                    if ($value == $row->getValue()) {
                        return $row->getConvertedValue();
                    }
                    break;
                default:
                    if ($value >= $row->getValue()) {
                        return $row->getConvertedValue();
                    }
            }

        }
        return 0;
    }
}
