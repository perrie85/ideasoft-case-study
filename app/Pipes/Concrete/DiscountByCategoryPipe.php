<?php

namespace App\Pipes\Concrete;

use App\Dto\DiscountPipelineDto;
use App\Enums\DiscountTypeEnum;
use App\Pipes\Contracts\PipeContract;
use Closure;

class DiscountByCategoryPipe implements PipeContract
{
    public function handle(DiscountPipelineDto $data, Closure $next)
    {
        $discounts = $data->discounts->where('type', DiscountTypeEnum::DISCOUNT_BY_CATEGORY->value);

        $discounts->map(function ($discount) use ($data) {
            $matchingOrderProducts = $data->order->orderProducts->where('product.category_id', $discount->category_id);

            if ($matchingOrderProducts->count() >= 2) {
                $cheapestProduct = $matchingOrderProducts->sortBy('unit_price')->first();
                $discount = $cheapestProduct->unit_price / 100 * 20;

                $data->totalDiscount += $discount;
                $data->discountedTotal -= $discount;

                $data->appliedDiscountResults[] = [
                    'discount_reason' => DiscountTypeEnum::DISCOUNT_BY_CATEGORY->value,
                    'discount_amount' => $discount,
                    'subtotal' => $data->discountedTotal,
                ];
            }
        });

        return $next($data);
    }
}
