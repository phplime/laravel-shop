<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vendor_cart_items', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id')->nullable()->after('customer_id');
        });

        Schema::table('vendor_order_cart_session', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id')->nullable()->after('customer_id');
        });
    }

    public function down(): void
    {
        Schema::table('vendor_cart_items', function (Blueprint $table) {
            $table->dropColumn('owner_id');
        });

        Schema::table('vendor_order_cart_session', function (Blueprint $table) {
            $table->dropColumn('owner_id');
        });
    }
};
