<?php

namespace App\Models;

class DVD extends Product
{
    private string $unit = 'MB';

    public function getUnit()
    {
        return $this->unit;
    }
}