<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('shipping_options')) {
            Schema::create('shipping_options', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('estimated_time')->nullable();
                $table->decimal('additional_cost', 10, 2)->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('product_shipping_option')) {
            Schema::create('product_shipping_option', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->foreignId('shipping_option_id')->constrained('shipping_options')->onDelete('cascade');
                $table->timestamps();

                $table->unique(['product_id', 'shipping_option_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('product_shipping_option');
        Schema::dropIfExists('shipping_options');
    }
};
