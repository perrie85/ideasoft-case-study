<?php

namespace App\Http\Controllers;

use Illuminate\Http\{JsonResponse, Response};

abstract class Controller
{
    public function successResponse($data): JsonResponse
    {
        return response()->json($data);
    }
}
