<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OrderProductRepository
{
    protected function model(): string
    {
        return Order::class;
    }

    public function index(): Collection
    {
        return $this->model()::get();
    }

    public function show(int|string $id): ?Model
    {
        return $this->model()::findOrFail($id);
    }

    public function store(array $data): Model
    {
        return $this->model()::create($data);
    }

    public function update(int|string $id, array $data): Model
    {
        return $this->model()::find($id)->update($data);
    }

    public function destroy(int|string $id)
    {
        return $this->model()::destroy($id);
    }
}
