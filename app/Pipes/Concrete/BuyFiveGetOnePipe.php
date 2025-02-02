<?php

namespace App\Pipes\Concrete;

use App\Dto\DiscountPipelineDto;
use App\Enums\DiscountTypeEnum;
use App\Pipes\Contracts\PipeContract;
use Closure;

class BuyFiveGetOnePipe implements PipeContract
{
    public function handle(DiscountPipelineDto $data, Closure $next)
    {
        $discounts = $data->discounts->where('type', DiscountTypeEnum::BUY_5_GET_1->value);

        $discounts->map(function ($discount) use ($data) {
            $matchingOrderProducts = $data->order->orderProducts->where('product.category_id', $discount->category_id);

            if ($matchingOrderProducts->count() > 0) {
                foreach ($matchingOrderProducts as $orderProduct) {
                    if ($orderProduct->quantity >= 6) {
                        $discountOnProduct = floor($orderProduct->quantity / 6) * $orderProduct->unit_price;

                        $data->totalDiscount += $discountOnProduct;
                        $data->discountedTotal -= $discountOnProduct;

                        $data->appliedDiscountResults[] = [
                            'discount_reason' => DiscountTypeEnum::BUY_5_GET_1->value,
                            'discount_amount' => $discountOnProduct,
                            'subtotal' => $data->discountedTotal,
                        ];
                    }
                }
            }
        });

        return $next($data);
    }
}
