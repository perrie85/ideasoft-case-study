<?php

namespace App\Pipes\Contracts;

use Closure;
use App\Dto\DiscountPipelineDto;

interface PipeContract
{
    /**
     * @param DiscountPipelineDto $data
     * @param Closure $next
     */
    public function handle(DiscountPipelineDto $data, Closure $next);
}
