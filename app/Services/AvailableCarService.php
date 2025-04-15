<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Car;

class AvailableCarService
{
    public function getAvailableCars(Employee $employee, array $filters)
    {
        $allowedCategories = $employee->comfortCategories->pluck('id');

        $cars = Car::query()
            ->whereIn('car_comfort_category_id', $allowedCategories)
            ->when($filters['model'] ?? null, fn ($q, $model) => $q->where('model', 'like', "%$model%"))
            ->when($filters['comfort_category_id'] ?? null, fn ($q, $id) => $q->where('car_comfort_category_id', $id))
            ->whereDoesntHave('bookings', function ($query) use ($filters) {
                $query->where(function ($q) use ($filters) {
                    $q->where('starts_at', '<', $filters['ends_at'])
                        ->where('ends_at', '>', $filters['starts_at']);
                });
            })
            ->with(['driver', 'comfortCategory'])
            ->get();

        return $cars;
    }
}
