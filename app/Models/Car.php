<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;
    protected $table = [
        'model',
        'driver_id',
        'car_comfort_category_id',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(CarBooking::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function comfortCategory(): BelongsTo
    {
        return $this->belongsTo(CarComfortCategory::class);
    }
}
