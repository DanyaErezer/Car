<?php

namespace Database\Factories;

use App\Models\CarComfortCategory;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model' => $this->faker->randomElement(['Toyota', 'Honda', 'Ford']),
            'driver_id' => Driver::factory(),
            'car_comfort_category_id' => CarComfortCategory::factory(),
        ];
    }
}
