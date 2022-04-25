<?php

namespace App\Services\Type\Index;

class TypeIndexResponse
{
    private array $types;

    public function __construct(array $types)
    {
        $this->types = $types;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

}