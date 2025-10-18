<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::where('is_active', true)->get();

        if ($products->isEmpty()) {
            return;
        }

        // Bersihkan order hasil seeder sebelumnya
        Order::where('delivery_note', 'like', 'Seeder order for product%')->delete();

        $customers = [
            [
                'name' => 'Andi Saputra',
                'phone' => '081234567890',
                'address' => 'Jl. Melati No. 12, Bandung',
                'payment_method' => 'Transfer Bank',
            ],
            [
                'name' => 'Siti Rahma',
                'phone' => '081298765432',
                'address' => 'Jl. Kenanga No. 5, Depok',
                'payment_method' => 'COD',
            ],
            [
                'name' => 'Budi Santoso',
                'phone' => '082112223334',
                'address' => 'Jl. Mawar No. 8, Surabaya',
                'payment_method' => 'Transfer Bank',
            ],
            [
                'name' => 'Lina Kartika',
                'phone' => '085612345678',
                'address' => 'Jl. Cempaka No. 20, Yogyakarta',
                'payment_method' => 'Transfer Bank',
            ],
        ];

        $defaultReviews = [
            'Rasanya enak dan pengiriman cepat.',
            'Kualitasnya mantap, sangat direkomendasikan!',
            'Harga sesuai kualitas, bakal repeat order.',
            'Kemasan rapi dan barang sampai sesuai foto.',
            'Produk berkualitas, pelayanan ramah.',
        ];

        foreach ($products as $index => $product) {
            $customer = $customers[$index % count($customers)];
            $qty = max(1, random_int(1, 3));
            $shippingCost = [12000, 15000, 18000, 20000][$index % 4];
            $rating = random_int(4, 5);
            $reviewText = $defaultReviews[$index % count($defaultReviews)];

            $deliveryNote = 'Seeder order for product ' . $product->id;
            $price = (float) $product->price;
            $subtotal = $price * $qty;
            $total = $subtotal + $shippingCost;

            $order = Order::updateOrCreate(
                ['delivery_note' => $deliveryNote],
                [
                    'user_id' => null,
                    'customer_name' => $customer['name'],
                    'phone' => $customer['phone'],
                    'address' => $customer['address'],
                    'delivery_note' => $deliveryNote,
                    'payment_method' => $customer['payment_method'],
                    'virtual_account' => $customer['payment_method'] === 'Transfer Bank'
                        ? '8801' . str_pad((string) $product->id, 8, '0', STR_PAD_LEFT)
                        : null,
                    'shipping_cost' => $shippingCost,
                    'total' => $total,
                    'status' => 'completed',
                ]
            );

            $order->items()->delete();

            $order->items()->create([
                'product_id' => $product->id,
                'price' => $price,
                'qty' => $qty,
                'subtotal' => $subtotal,
                'rating' => $rating,
                'review' => $reviewText,
                'rated_at' => Carbon::now()->subDays(random_int(5, 30)),
            ]);

            $daysAgo = random_int(15, 60);
            $order->updateQuietly([
                'created_at' => Carbon::now()->subDays($daysAgo),
                'updated_at' => Carbon::now()->subDays(random_int(1, $daysAgo - 1)),
            ]);
        }
    }
}
