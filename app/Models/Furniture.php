<?php

namespace App\Models;

class Furniture extends Product
{
    private string $unit = '';

    public function getUnit()
    {
        return $this->unit;
    }
}