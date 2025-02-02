<?php

namespace App\Pipes\Concrete;

use App\Dto\DiscountPipelineDto;
use App\Enums\DiscountTypeEnum;
use App\Pipes\Contracts\PipeContract;
use Closure;

class DiscountByTotalPipe implements PipeContract
{
    public function handle(DiscountPipelineDto $data, Closure $next)
    {
        $discounts = $data->discounts->where('type', DiscountTypeEnum::DISCOUNT_BY_TOTAL->value);

        $discounts->map(function ($discount) use ($data) {
            if ($discount->total <= $data->order->total) {
                $discount = $data->order->total / 100 * 10;

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
