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
            $table->unsignedBigInteger('customer_id')->nullable()->after('user_id');
            // $table->foreign('customer_id')->references('id')->on('customer_list')->onDelete('cascade');
        });

        Schema::table('vendor_order_cart_session', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->nullable()->after('user_id');
            // $table->foreign('customer_id')->references('id')->on('customer_list')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendor_cart_items', function (Blueprint $table) {
            $table->dropColumn('customer_id');
        });

        Schema::table('vendor_order_cart_session', function (Blueprint $table) {
            $table->dropColumn('customer_id');
        });
    }
};
