<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer'],
            'items' => ['required', 'array'],
            'items.0' => ['required'],
            'items.*' => ['array'],
            'items.*.quantity' => ['required', 'integer'],
            'items.*.product_id' => ['required', 'integer'],
        ];
    }
}
