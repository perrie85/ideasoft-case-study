<?php

namespace App\Services;

use App\Dto\DiscountPipelineDto;
use App\Http\Resources\OrderDiscountResource;
use App\Pipes\Concrete\BuyFiveGetOnePipe;
use App\Pipes\Concrete\DiscountByCategoryPipe;
use App\Pipes\Concrete\DiscountByTotalPipe;
use App\Repositories\DiscountRepository;
use App\Repositories\OrderRepository;
use Illuminate\Pipeline\Pipeline;

class OrderDiscountService
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly DiscountRepository $discountRepository,
        private Pipeline $pipeline,
    ) {}

    private array $pipes = [
        BuyFiveGetOnePipe::class,
        DiscountByCategoryPipe::class,
        DiscountByTotalPipe::class,
    ];

    public function handle(int $orderId): OrderDiscountResource
    {
        /**
         * Potential functionality for adding different types of discounts using this structure would be 
         *  - adding a percentage column in discounts table, to use for different types of discounts
         *  - adding strictness by rules on validation, ie: if you have an active total based discount, new ones shouldnt be allowed
         *  - also there is functionality to be able to add product based discounts (datawise), but handling for it is not implemented in this project
         *  - another update could be adding a title/slug type value for the reason with what data is being used on the discount for increased readibility
         *  - currently crud implementation is not implemented but handling for the discounts are 
         *      implemented considering we can have multiple discounts based on categories and products
         *  - if we want a new discount logic, it can be implemented as a pipe, and can be added in $pipes array above to be handle
         *  - another improvement and honestly a necessity would be storing the applied discounts related to the order itself
         */

        $order = $this->orderRepository->show($orderId);

        $activeDiscounts = $this->discountRepository->getActiveDiscounts();

        return $this->pipeline
            ->send(new DiscountPipelineDto($order, $activeDiscounts, [], 0, $order->total))
            ->through($this->pipes)
            ->then(function ($pipelineData) {
                return OrderDiscountResource::make($pipelineData);
            });
    }
}
