<?php
<<<<<<< HEAD

namespace App\Models;

=======
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> adaac3a (cece)
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;

>>>>>>> adaac3a (cece)
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
<<<<<<< HEAD

=======
>>>>>>> adaac3a (cece)
