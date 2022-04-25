<?php

namespace App\Models;

class Book extends Product
{
    private string $unit = 'KG';

    public function getUnit(): string
    {
        return $this->unit;
    }
}