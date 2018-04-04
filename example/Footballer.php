<?php

use FFC\Formation\Footballer\FootballerAbstract;

class Footballer extends FootballerAbstract
{
    public function __construct($code)
    {
        $this->setCode($code);
    }
}
