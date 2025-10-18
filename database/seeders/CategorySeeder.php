<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Pakaian',
            'Makanan & Minuman',
            'Aksesoris',
            'Alat Tulis',
            'Perlengkapan Elektronik',
            'Kecantikan',
        ];

        foreach ($categories as $name) {
            Category::updateOrCreate(
                ['name' => $name],
                []
            );
        }
    }
}
