<?php

namespace App\Enums;

enum DiscountTypeEnum: string
{
    case BUY_5_GET_1 = 'BUY_5_GET_1';
    case DISCOUNT_BY_TOTAL = 'DISCOUNT_BY_TOTAL';
    case DISCOUNT_BY_CATEGORY = 'DISCOUNT_BY_CATEGORY';
}
