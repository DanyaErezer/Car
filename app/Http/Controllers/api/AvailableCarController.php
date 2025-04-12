<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvailableCarRequest;
use App\Services\AvailableCarService;
use Illuminate\Http\JsonResponse;

class AvailableCarController extends Controller
{
    public function index(AvailableCarRequest $request, AvailableCarService $service): JsonResponse
    {
        $availableCars = $service->getAvailableCars($request->user(), $request->validated());

        return response()->json($availableCars);
    }
}
