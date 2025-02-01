<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\Store;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    public function index(): JsonResponse
    {
        return $this->successResponse($this->orderService->index());
    }

    public function store(Store $request): JsonResponse
    {
        return $this->successResponse($this->orderService->store($request->validated()));
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->successResponse(['message' => $this->orderService->destroy($id) ? 'Order deleted successfully.' : 'Something went wrong.']);
    }
}
