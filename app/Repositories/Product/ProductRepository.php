<?php

namespace App\Repositories\Product;

interface ProductRepository
{
    public function index();
    public function store(array $productInputData, string $productValue);
    public function delete(int $id);
}