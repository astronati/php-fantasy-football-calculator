<?php

namespace FFC\Calculator\ConversionTable;

class ForwardConversionTable extends ConversionTableAbstract
{
    public function __construct()
    {
        $this->table = [
          new ConversionTableRow(8, 2),
          new ConversionTableRow(7.5, 1.5),
          new ConversionTableRow(7, 1),
          new ConversionTableRow(6.5, 0.5),
        ];
    }
}
