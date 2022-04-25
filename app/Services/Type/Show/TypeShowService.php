<?php

namespace App\Services\Type\Show;

use App\Models\InputAttribute;
use App\Models\Type;
use App\Repositories\Type\TypeRepository;

class TypeShowService
{
    private TypeRepository $typeRepository;

    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    public function execute(TypeShowRequest $request): TypeShowResponse
    {
        $typeAttributesQuery = $this->typeRepository->show($request->getTypeId());

        $type = new Type($typeAttributesQuery['id'], $typeAttributesQuery['type_name']);
        $inputAttribute = new InputAttribute($typeAttributesQuery['input_label'], $typeAttributesQuery['unit'], $typeAttributesQuery['description']);
        $inputAttribute->setLabel();

        return new TypeShowResponse($type, $inputAttribute);
    }
}