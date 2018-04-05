<?php

namespace FFC\Calculator\ConversionTable;

use FFC\Calculator\ConversionTable\Row\ConversionTableRow;

class MidfieldConversionTable extends ConversionTableAbstract
{
    public function __construct()
    {
        // Maps the difference of the vote average of both midfields with the related bonus/malus to apply both teams.
        // The bonus to the better team and the malus to the other...
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
