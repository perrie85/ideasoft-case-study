<?php

namespace App\Http\Controllers;

use App\Services\OrderDiscountService;

class CalculateOrderDiscountController extends Controller
{
    public function __construct(private readonly OrderDiscountService $service) {}

    public function __invoke(int $orderId)
    {
        return $this->successResponse([$this->service->handle($orderId)]);
    }
}
