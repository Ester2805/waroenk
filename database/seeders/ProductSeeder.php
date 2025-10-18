<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Indomie Goreng',
                'description' => 'Mi instan rasa goreng spesial.',
                'price' => 3000,
                'stock' => 120,
                'image_path' => 'images/product/indomie.jpg',
                'category' => 'Makanan & Minuman',
            ],
            [
                'name' => 'Gulaku Gula Tebu',
                'description' => 'Gula tebu premium ukuran 1 kg.',
                'price' => 15000,
                'stock' => 80,
                'image_path' => 'images/product/gulaku.jpg',
                'category' => 'Makanan & Minuman',
            ],
            [
                'name' => 'Minyak Goreng',
                'description' => 'Minyak goreng 2 liter dari bahan kelapa sawit pilihan.',
                'price' => 28000,
                'stock' => 60,
                'image_path' => 'images/product/minyak.jpg',
                'category' => 'Makanan & Minuman',
            ],
            [
                'name' => 'Kaos Batik Modern',
                'description' => 'Kaos motif batik kombinasi katun nyaman untuk sehari-hari.',
                'price' => 85000,
                'stock' => 45,
                'image_path' => 'images/product/kaos-batik.jpg',
                'category' => 'Pakaian',
            ],
            [
                'name' => 'Kemeja Tenun Ikat',
                'description' => 'Kemeja tenun ikat handmade dari pengrajin lokal.',
                'price' => 165000,
                'stock' => 30,
                'image_path' => 'images/product/kemeja-tenun.jpg',
                'category' => 'Pakaian',
            ],
            [
                'name' => 'Keripik Singkong Balado',
                'description' => 'Keripik singkong renyah rasa balado pedas manis.',
                'price' => 18000,
                'stock' => 150,
                'image_path' => 'images/product/keripik-singkong.jpg',
                'category' => 'Makanan & Minuman',
            ],
            [
                'name' => 'Gelang Manik Kulit',
                'description' => 'Gelang handmade kombinasi kulit dan manik-manik kayu.',
                'price' => 32000,
                'stock' => 90,
                'image_path' => 'images/product/gelang-kulit.jpg',
                'category' => 'Aksesoris',
            ],
            [
                'name' => 'Anting Kuningan Etnik',
                'description' => 'Anting kuningan etnik dengan sentuhan modern.',
                'price' => 27000,
                'stock' => 75,
                'image_path' => 'images/product/anting-kuningan.jpg',
                'category' => 'Aksesoris',
            ],
            [
                'name' => 'Notebook Daur Ulang',
                'description' => 'Buku catatan dengan kertas daur ulang ramah lingkungan.',
                'price' => 28000,
                'stock' => 110,
                'image_path' => 'images/product/notebook-daur-ulang.jpg',
                'category' => 'Alat Tulis',
            ],
            [
                'name' => 'Paket Pena Kayu',
                'description' => 'Set pena kayu ukir dengan tinta isi ulang.',
                'price' => 54000,
                'stock' => 65,
                'image_path' => 'images/product/pena-kayu.jpg',
                'category' => 'Alat Tulis',
            ],
            [
                'name' => 'Lampu Meja Kayu',
                'description' => 'Lampu meja dengan kaki kayu jati dan kap anyaman.',
                'price' => 150000,
                'stock' => 25,
                'image_path' => 'images/product/lampu-kayu.jpg',
                'category' => 'Perlengkapan Elektronik',
            ],
            [
                'name' => 'Speaker Mini Bambu',
                'description' => 'Speaker bluetooth portable dengan casing bambu.',
                'price' => 185000,
                'stock' => 40,
                'image_path' => 'images/product/speaker-bambu.jpg',
                'category' => 'Perlengkapan Elektronik',
            ],
            [
                'name' => 'Serum Wajah Herbal',
                'description' => 'Serum wajah alami dengan kandungan lidah buaya dan vitamin C.',
                'price' => 99000,
                'stock' => 70,
                'image_path' => 'images/product/serum-herbal.jpg',
                'category' => 'Kecantikan',
            ],
            [
                'name' => 'Lulur Kopi Nusantara',
                'description' => 'Scrub tubuh dari bubuk kopi dan minyak kelapa.',
                'price' => 45000,
                'stock' => 85,
                'image_path' => 'images/product/lulur-kopi.jpg',
                'category' => 'Kecantikan',
            ],
            [
                'name' => 'Pensil Mekanik 0.5mm',
                'description' => 'Pensil mekanik dengan grip empuk untuk menulis dan menggambar.',
                'price' => 12000,
                'stock' => 45,
                'image_path' => 'public/images/product/pensil-mekanik.jpg',
                'category' => 'Alat Tulis',
            ],
            [
                'name' => 'Buku Binder A5',
                'description' => 'Buku binder ukuran A5 dengan ring kuat dan isi ulang kertas bergaris.',
                'price' => 28000,
                'stock' => 30,
                'image_path' => 'public/images/product/binder-a5.jpg',
                'category' => 'Alat Tulis',
            ],
            [
                'name' => 'Rautan Pensil Otomatis',
                'description' => 'Rautan pensil otomatis mini dengan sisa rautan tertampung rapi.',
                'price' => 18000,
                'stock' => 25,
                'image_path' => 'public/images/product/rautan.jpg',
                'category' => 'Alat Tulis',
            ],
            [
                'name' => 'Gunting Kertas',
                'description' => 'Gunting stainless ukuran sedang untuk keperluan kantor dan sekolah.',
                'price' => 15000,
                'stock' => 40,
                'image_path' => 'public/images/product/gunting.jpg',
                'category' => 'Alat Tulis',
            ],
            [
                'name' => 'Penggaris Logam 30cm',
                'description' => 'Penggaris berbahan logam tahan lama dan akurat untuk gambar teknik.',
                'price' => 12000,
                'stock' => 30,
                'image_path' => 'public/images/product/penggaris-logam.jpg',
                'category' => 'Alat Tulis',
            ],
            [
                'name' => 'Powerbank 10000mAh',
                'description' => 'Powerbank slim dengan kapasitas 10000mAh dan fitur fast charging.',
                'price' => 185000,
                'stock' => 30,
                'image_path' => 'public/images/product/powerbank.jpg',
                'category' => 'Perlengkapan Elektronik',
            ],
            [
                'name' => 'Headset Bluetooth',
                'description' => 'Headset nirkabel dengan suara jernih dan bass kuat.',
                'price' => 350000,
                'stock' => 25,
                'image_path' => 'public/images/product/headset.jpg',
                'category' => 'Perlengkapan Elektronik',
            ],
            [
                'name' => 'Flashdisk 64GB',
                'description' => 'Flashdisk USB 3.0 kecepatan tinggi dengan kapasitas 64GB.',
                'price' => 95000,
                'stock' => 45,
                'image_path' => 'public/images/product/flashdisk-sandisk.jpg',
                'category' => 'Perlengkapan Elektronik',
            ],
            [
                'name' => 'Adaptor Laptop Universal',
                'description' => 'Adaptor serbaguna kompatibel untuk berbagai merk laptop.',
                'price' => 180000,
                'stock' => 30,
                'image_path' => 'public/images/product/adaptor-universal.jpg',
                'category' => 'Perlengkapan Elektronik',
            ],
            [
                'name' => 'Kipas Meja USB Mini',
                'description' => 'Kipas kecil bertenaga USB untuk meja kerja atau belajar.',
                'price' => 45000,
                'stock' => 40,
                'image_path' => 'public/images/product/kipaskecil.jpg',
                'category' => 'Perlengkapan Elektronik',
            ],
        ];

        foreach ($items as $item) {
            $category = Category::firstWhere('name', $item['category']);

            Product::updateOrCreate(
                ['name' => $item['name']],
                [
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'image_path' => $item['image_path'],
                    'category_id' => $category?->id,
                    'is_active' => true,
                ]
            );
        }
    }
}
