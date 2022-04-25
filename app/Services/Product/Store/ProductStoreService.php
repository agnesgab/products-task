<?php

namespace App\Services\Product\Store;

use App\Repositories\Product\ProductRepository;

class ProductStoreService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(ProductStoreRequest $request)
    {
        $productInputData = array_chunk($request->getProductInputData(), 5);
        $productValue = implode('x', $productInputData[1]);

        $this->productRepository->store($request->getProductInputData(), $productValue);
    }
}