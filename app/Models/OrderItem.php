<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> adaac3a (cece)
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
<<<<<<< HEAD
    protected $fillable = [
        'order_id', 'product_name', 'variation', 'price', 'quantity'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
=======
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
        'subtotal',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
>>>>>>> adaac3a (cece)
    }
}
