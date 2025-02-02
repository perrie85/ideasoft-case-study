<?php

namespace App\Dto;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class DiscountPipelineDto
{
    /**
     * @param Order $order
     * @param Collection $discounts
     * @param ?array $appliedDiscountResults
     */
    public function __construct(
        public Order $order,
        public Collection $discounts,
        public ?array $appliedDiscountResults = null,
        public float $totalDiscount = 0,
        public float $discountedTotal = 0,
    ) {}
}
