<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Baju Kaos',
            'description' => 'Kaos nyaman dipakai sehari-hari',
            'price' => 75000,
            'image' => 'baju_kaos.jpg',
        ]);

        Product::create([
            'name' => 'Celana Jeans',
            'description' => 'Celana jeans kualitas premium',
            'price' => 150000,
            'image' => 'celana_jeans.jpg',
        ]);
    }
}
