<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID unik tiap produk
            $table->string('name'); // Nama produk
            $table->text('description')->nullable(); // Deskripsi produk (opsional)
            $table->decimal('price', 10, 2); // Harga produk
            $table->integer('stock')->default(0); // Jumlah stok
            $table->string('image_path')->nullable(); // Path gambar produk
            $table->unsignedBigInteger('category_id')->nullable(); // Relasi ke kategori (opsional)
            $table->boolean('is_active')->default(true); // Status aktif/tidak
            $table->timestamps(); // created_at & updated_at

            // Kalau nanti kamu buat tabel categories, ini bisa diaktifkan:
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
