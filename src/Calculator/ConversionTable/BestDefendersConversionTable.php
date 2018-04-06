<?php

namespace FFC\Calculator\ConversionTable;

use FFC\Calculator\ConversionTable\Row\ConversionTableRow;

class BestDefendersConversionTable extends ConversionTableAbstract
{
    public function __construct()
    {
        // Maps the defense vote average (3 best defenders and goal keeper) with the related bonus
        $this->table = [
          new ConversionTableRow(7, 6),
          new ConversionTableRow(6.5, 3),
          new ConversionTableRow(6, 1),
        ];
    }
}
