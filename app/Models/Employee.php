<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
    ];
    public function comfortCategories(): BelongsToMany
    {
        return $this->belongsToMany(CarComfortCategory::class, 'employee_comfort_categories');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(CarBooking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
