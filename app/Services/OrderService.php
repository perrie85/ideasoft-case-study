<?php

namespace App\Services;

use App\Exceptions\ProductStockException;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(
        private readonly OrderRepository $repository,
        private readonly ProductRepository $productRepository
    ) {}

    public function index(): AnonymousResourceCollection
    {
        return OrderResource::collection($this->repository->index());
    }

    public function store(array $data): OrderResource
    {
        $orderProducts = $data['items'];
        unset($data['items']);

        DB::beginTransaction();
        $order = $this->repository->store($data);

        $orderTotal = 0;
        foreach ($orderProducts as $orderProduct) {
            try {
                $product = $this->productRepository->show($orderProduct['product_id']);

                if ($orderProduct['quantity'] > $product->stock) {
                    throw new ProductStockException;
                }

                $product->stock = $product->stock - $orderProduct['quantity'];
                $product->save();

                $totalForProduct = $orderProduct['quantity'] * $product->price;
                $orderTotal += $totalForProduct;

                $order->products()->attach(
                    $product->id,
                    [
                        'quantity' => $orderProduct['quantity'],
                        'unit_price' => $product->price,
                        'total' => $totalForProduct,
                    ]
                );
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        }

        $order->total = $orderTotal;
        $order->save();
        DB::commit();

        return OrderResource::make($order->refresh()->load('orderProducts'));
    }

    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }
}
