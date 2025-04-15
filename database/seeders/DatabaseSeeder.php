<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarBooking;
use App\Models\CarComfortCategory;
use App\Models\Driver;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = CarComfortCategory::factory()->count(3)->create();
        $users = User::factory()->count(5)->create();
        $employees = $users->map(function ($user) {
            return Employee::factory()->create([
                'user_id' => $user->id,
            ]);
        });
        $drivers = Driver::factory()->count(5)->create();
        foreach ($employees as $employee) {
            $employee->comfortCategories()->attach(
                $categories->random(rand(1, 2))->pluck('id')
            );
        }
        $cars = Car::factory()
            ->count(5)
            ->make()
            ->each(function ($car) use ($drivers, $categories) {
                $car->driver_id = $drivers->random()->id;
                $car->car_comfort_category_id = $categories->random()->id;
                $car->save();
            });
        // Пример бронирования
        $employee = $employees->first();
        CarBooking::create([
            'employee_id' => $employee->id,
            'car_id' => $cars->first()->id,
            'start_at' => now()->addHours(1),
            'ends_at' => now()->addHours(3),
        ]);

        info('TOKEN: ' . User::first()->createToken('SeedToken')->plainTextToken);
    }
}
