<?php

namespace App\Services\Type\Index;

use App\Models\Type;
use App\Repositories\Type\TypeRepository;

class TypeIndexService
{
    private TypeRepository $typeRepository;

    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    public function execute()
    {
        $productTypesQuery = $this->typeRepository->index();

        $types = [];
        foreach ($productTypesQuery as $data) {
            $types[] = new Type(
                $data['id'],
                $data['type_name']
            );
        }

        return new TypeIndexResponse($types);
    }
}