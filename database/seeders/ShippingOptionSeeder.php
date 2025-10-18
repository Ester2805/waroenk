<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingOption;
use App\Models\Product;

class ShippingOptionSeeder extends Seeder
{
    public function run(): void
    {
        $options = [
            [
                'name' => 'JNE Reguler',
                'estimated_time' => '2-4 hari',
                'additional_cost' => 15000,
                'is_active' => true,
            ],
            [
                'name' => 'J&T Express',
                'estimated_time' => '2-3 hari',
                'additional_cost' => 14000,
                'is_active' => true,
            ],
            [
                'name' => 'SiCepat BEST',
                'estimated_time' => '1-2 hari',
                'additional_cost' => 20000,
                'is_active' => true,
            ],
            [
                'name' => 'GoSend Same Day',
                'estimated_time' => '0-1 hari',
                'additional_cost' => 25000,
                'is_active' => true,
            ],
            [
                'name' => 'Pick Up di Toko',
                'estimated_time' => 'Ambil langsung',
                'additional_cost' => 0,
                'is_active' => true,
            ],
        ];

        $optionIds = [];
        foreach ($options as $data) {
            $option = ShippingOption::updateOrCreate(
                ['name' => $data['name']],
                [
                    'estimated_time' => $data['estimated_time'],
                    'additional_cost' => $data['additional_cost'],
                    'is_active' => $data['is_active'],
                ]
            );
            $optionIds[] = $option->id;
        }

        $products = Product::all();
        foreach ($products as $product) {
            $product->shippingOptions()->syncWithoutDetaching($optionIds);
        }
    }
}
