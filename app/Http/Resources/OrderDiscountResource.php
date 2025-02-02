<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'orderId' => $this->order->id,
            'discounts' => AppliedDiscountResource::collection($this->appliedDiscountResults),
            'totalDiscount' => $this->totalDiscount,
            'discountedTotal' => $this->discountedTotal,
        ];
    }
}
