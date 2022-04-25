<?php

namespace App\Models;

class InputAttribute
{
    private string $inputLabel;
    private string $unit;
    private string $description;
    private array $label;

    public function __construct(string $inputLabel, string $unit, string $description)
    {
        $this->inputLabel = $inputLabel;
        $this->unit = $unit;
        $this->description = $description;
    }

    public function setLabel()
    {
        $this->label = explode(',', $this->inputLabel);
    }

    public function getLabel(): array
    {
        return $this->label;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getInputLabel(): string
    {
        return $this->inputLabel;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}