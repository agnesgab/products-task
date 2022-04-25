<?php

namespace App\Services\Product\Delete;

class ProductDeleteRequest
{
    private array $productsToDelete;

    public function __construct(array $productsToDelete)
    {
        $this->productsToDelete = $productsToDelete;
    }

    public function getProductsToDelete(): array
    {
        return $this->productsToDelete;
    }
}