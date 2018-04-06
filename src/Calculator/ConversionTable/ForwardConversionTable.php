<?php

namespace FFC\Calculator\ConversionTable;

use FFC\Calculator\ConversionTable\Row\ConversionTableRow;

class ForwardConversionTable extends ConversionTableAbstract
{
    public function __construct()
    {
        // Maps the vote of the single footballer (if he didn't score) with the related own bonus
        $this->table = [
          new ConversionTableRow(8, 2),
          new ConversionTableRow(7.5, 1.5),
          new ConversionTableRow(7, 1),
          new ConversionTableRow(6.5, 0.5),
        ];
    }
}
