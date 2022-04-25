<?php

namespace App\Services\Product\Index;

use App\Models\Attribute;
use App\Repositories\Product\ProductRepository;

class ProductIndexService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute()
    {
        $productsQuery = $this->productRepository->index();
        $products = [];

        foreach ($productsQuery as $data) {
            // Create new object from product type name, e.g. App\Models\Furniture;
            $class = "App\Models\\{$data['type_name']}";
            $product = new $class($data['product_id'], $data['sku'], $data['name'], $data['price']);

            // Set attribute values for product of current type, e.g. Furniture->setItemAttributeValues(Dimension, 70x70x70, CM)
            $product->setItemAttributeValues(new Attribute($data['attribute_name'], $data['value'], $data['unit']));
            // Array of DVD, Book and Furniture objects
            $products[] = $product;
        }

        return new ProductIndexResponse($products);
    }
}