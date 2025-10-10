<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Indomie Goreng',
            'description' => 'Mi instan rasa goreng spesial',
            'price' => 3000,
            'image' => 'indomie.jpg',
        ]);

        Product::create([
            'name' => 'Gulaku Gula Tebu',
            'description' => 'Gula tebu premium 1kg',
            'price' => 15000,
            'image' => 'gulaku.jpg',
        ]);

        Product::create([
            'name' => 'Minyak Goreng',
            'description' => 'Minyak goreng 2 liter',
            'price' => 28000,
            'image' => 'minyak.jpg',
        ]);
    }
}
