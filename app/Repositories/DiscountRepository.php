<?php

namespace App\Repositories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Collection;

class DiscountRepository
{
    protected function model(): string
    {
        return Discount::class;
    }

    public function getActiveDiscounts(): Collection
    {
        return $this->model()::where('is_active', true)->get();
    }
}
