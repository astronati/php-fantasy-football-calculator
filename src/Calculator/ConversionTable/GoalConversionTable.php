<?php

namespace FFC\Calculator\ConversionTable;

class GoalConversionTable extends ConversionTableAbstract
{
    public function __construct()
    {
        $this->table = [
          new ConversionTableRow(120, 10),
          new ConversionTableRow(114, 9),
          new ConversionTableRow(108, 8),
          new ConversionTableRow(102, 7),
          new ConversionTableRow(96, 6),
          new ConversionTableRow(90, 5),
          new ConversionTableRow(84, 4),
          new ConversionTableRow(78, 3),
          new ConversionTableRow(72, 2),
          new ConversionTableRow(66, 1),
        ];
    }
}
