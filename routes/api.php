<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('order', OrderController::class)->only(['index', 'store', 'destroy']);
