<?php

namespace App\Services\Type\Show;

use App\Models\InputAttribute;
use App\Models\Type;

class TypeShowResponse
{
    private Type $type;
    private InputAttribute $inputAttribute;

    public function __construct(Type $type, InputAttribute $inputAttribute)
    {
        $this->type = $type;
        $this->inputAttribute = $inputAttribute;
    }

    public function getInputAttribute(): InputAttribute
    {
        return $this->inputAttribute;
    }

    public function getType(): Type
    {
        return $this->type;
    }
}