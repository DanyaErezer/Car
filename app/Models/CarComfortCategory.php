<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarComfortCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_comfort_categories');
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
