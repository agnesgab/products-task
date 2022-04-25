<?php

namespace App\Repositories\Type;

use App\Database;

class MysqlTypeRepository implements TypeRepository
{
    public function index(): array
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('id', 'type_name')
            ->from('types')
            ->executeQuery()
            ->fetchAllAssociative();
    }

    public function show(string $typeId)
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('types')
            ->where('type_name = ?')
            ->setParameter(0, $typeId)
            ->executeQuery()
            ->fetchAssociative();
    }
}