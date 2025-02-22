<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppliedDiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'discountReason' => $this['discount_reason'],
            'discountAmount' => $this['discount_amount'],
            'subtotal' => $this['subtotal'],
        ];
    }
}
