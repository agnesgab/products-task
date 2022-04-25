<?php

namespace App\Repositories\Type;

interface TypeRepository
{
    public function index();
    public function show(string $typeId);
}
