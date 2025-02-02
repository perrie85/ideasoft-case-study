<?php

use App\Http\Controllers\CalculateOrderDiscountController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('orders', OrderController::class)->only(['index', 'store', 'destroy']);

Route::get('/orders/{id}/discounts', CalculateOrderDiscountController::class);
