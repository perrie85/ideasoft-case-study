<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    protected function model(): string
    {
        return Product::class;
    }

    public function show(int $id): Product
    {
        return $this->model()::findOrFail($id);
    }
}
