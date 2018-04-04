<?php

namespace FFC\Calculator\ConversionTable;

class DefenseConversionTable extends ConversionTableAbstract
{
    public function __construct()
    {
        $this->table = [
          new ConversionTableRow(7, -5),
          new ConversionTableRow(6.75, -4),
          new ConversionTableRow(6.5, -3),
          new ConversionTableRow(6.25, -2),
          new ConversionTableRow(6, -1),
          new ConversionTableRow(5.75, 0),
          new ConversionTableRow(5.5, 1),
          new ConversionTableRow(5.25, 2),
          new ConversionTableRow(5, 3),
          new ConversionTableRow(0, 4),
        ];
    }
}
