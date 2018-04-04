<?php

namespace FFC\Calculator\ConversionTable;

class BestDefendersConversionTable extends ConversionTableAbstract
{
    public function __construct()
    {
        $this->table = [
          new ConversionTableRow(7, 6),
          new ConversionTableRow(6.5, 3),
          new ConversionTableRow(6, 1),
        ];
    }
}
