<?php

namespace App\Services\Product\Index;

class ProductIndexResponse
{
    private array $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}