<?php

namespace App\Services\Product\Store;

class ProductStoreRequest
{
    private array $productInputData;

    public function __construct(array $productInputData)
    {
        $this->productInputData = $productInputData;
    }

    public function getProductInputData(): array
    {
        return $this->productInputData;
    }
}