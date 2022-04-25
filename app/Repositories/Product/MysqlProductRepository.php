<?php

namespace App\Repositories\Product;

use App\Database;

class MysqlProductRepository implements ProductRepository
{
    public function index(): array
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('products', 'p')
            ->innerJoin('p', 'types', 't', 'p.type_id = t.id')
            ->executeQuery()
            ->fetchAllAssociative();
    }

    public function store(array $productInputData, string $productValue)
    {
        Database::connection()
            ->insert('products', [
                'type_id' => $productInputData['type_id'],
                'sku' => $productInputData['sku'],
                'name' => $productInputData['name'],
                'price' => $productInputData['price'],
                'value' => $productValue
            ]);
    }

    public function delete(int $id)
    {
        Database::connection()
            ->delete('products', ['product_id' => $id]);
    }
}