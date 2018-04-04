<?php

namespace FFC\Calculator\ConversionTable;

class MidfieldConversionTable extends ConversionTableAbstract
{
    public function __construct()
    {
        $this->table = [
          new ConversionTableRow(8, 4),
          new ConversionTableRow(7, 3.5),
          new ConversionTableRow(6, 3),
          new ConversionTableRow(5, 2.5),
          new ConversionTableRow(4, 2),
          new ConversionTableRow(3, 1.5),
          new ConversionTableRow(2, 1),
          new ConversionTableRow(1, 0.5),
        ];
    }
}
