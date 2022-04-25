<?php

namespace App\Models;

class Attribute
{
    private string $name;
    private string $value;
    private string $units;

    public function __construct(string $name, string $value, string $units)
    {
        $this->name = $name;
        $this->value = $value;
        $this->units = $units;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUnits(): string
    {
        return $this->units;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}