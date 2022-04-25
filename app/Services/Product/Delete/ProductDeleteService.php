<?php

namespace App\Services\Product\Delete;

use App\Repositories\Product\ProductRepository;

class ProductDeleteService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(ProductDeleteRequest $request)
    {
        $productsToDelete = $request->getProductsToDelete();
        foreach ($productsToDelete as $product) {
            foreach ($product as $id) {
                $this->productRepository->delete($id);
            }
        }
    }

}