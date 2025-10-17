<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    // 🧩 Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'name',
        'price',
        'description',
        'image_path',
        'stock',
        'category_id',
        'is_active',
    ];

    /**
     * 🔗 Relasi ke kategori (many-to-one)
     * Setiap produk hanya punya satu kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 🔗 Relasi ke order_items (one-to-many)
     * Produk bisa muncul di banyak pesanan
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shippingOptions()
    {
        return $this->belongsToMany(ShippingOption::class)->withTimestamps();
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image_path) {
            return null;
        }

        if (Str::startsWith($this->image_path, ['http://', 'https://'])) {
            return $this->image_path;
        }

        $relativePath = ltrim($this->image_path, '/');

        if (File::exists(public_path($relativePath))) {
            return asset($relativePath);
        }

        return asset('storage/' . $relativePath);
    }
}
