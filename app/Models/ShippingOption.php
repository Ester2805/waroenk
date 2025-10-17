<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'estimated_time',
        'additional_cost',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'additional_cost' => 'decimal:2',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
