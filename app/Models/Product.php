<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 🧩 Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'stock',
        'category_id',
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
}
