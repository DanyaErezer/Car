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
        $employee = $request->user()->employee;
        if (!$employee) {
            return response()->json(['error' => 'Employee not found for user'], 404);
        }
        $availableCars = $service->getAvailableCars($employee, $request->validated());

        return response()->json($availableCars);
    }
}
