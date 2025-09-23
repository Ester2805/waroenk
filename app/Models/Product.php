<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    //
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
    ];
=======
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
>>>>>>> bf98960 (punya ester)
}
