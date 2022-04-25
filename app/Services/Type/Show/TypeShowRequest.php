<?php

namespace App\Services\Type\Show;

class TypeShowRequest
{
    private string $typeId;

    public function __construct(string $typeId)
    {
        $this->typeId = $typeId;
    }

    public function getTypeId(): string
    {
        return $this->typeId;
    }
}