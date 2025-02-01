<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OrderRepository
{
    protected function model(): string
    {
        return Order::class;
    }

    public function index(): Collection
    {
        return $this->model()::query()->with('orderProducts')->get();
    }

    public function store(array $data): Model
    {
        return $this->model()::create($data);
    }

    public function destroy(int $id)
    {
        return $this->model()::destroy($id);
    }
}
