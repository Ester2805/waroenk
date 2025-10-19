<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'delivery_note')) {
                $table->string('delivery_note', 255)->nullable()->after('address');
            }

            if (! Schema::hasColumn('orders', 'virtual_account')) {
                $table->string('virtual_account')->nullable()->after('payment_method');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'delivery_note')) {
                $table->dropColumn('delivery_note');
            }

            if (Schema::hasColumn('orders', 'virtual_account')) {
                $table->dropColumn('virtual_account');
            }
        });
    }
};
