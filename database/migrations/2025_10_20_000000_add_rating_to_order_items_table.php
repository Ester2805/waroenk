<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (! Schema::hasColumn('order_items', 'rating')) {
                $table->unsignedTinyInteger('rating')->nullable()->after('subtotal');
            }
            if (! Schema::hasColumn('order_items', 'review')) {
                $table->text('review')->nullable()->after('rating');
            }
            if (! Schema::hasColumn('order_items', 'rated_at')) {
                $table->timestamp('rated_at')->nullable()->after('review');
            }
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (Schema::hasColumn('order_items', 'rating')) {
                $table->dropColumn('rating');
            }
            if (Schema::hasColumn('order_items', 'review')) {
                $table->dropColumn('review');
            }
            if (Schema::hasColumn('order_items', 'rated_at')) {
                $table->dropColumn('rated_at');
            }
        });
    }
};
