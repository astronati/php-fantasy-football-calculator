<?php

namespace FFC\Calculator\ConversionTable;

class GoalBonusSince2017ConversionTable extends ConversionTableAbstract
{
    public function __construct()
    {
        $this->table = [
          new ConversionTableRow('P', 5),
          new ConversionTableRow('D', 4.5),
          new ConversionTableRow('C', 4),
          new ConversionTableRow('T', 3.5),
          new ConversionTableRow('A', 3),
        ];
    }
}
