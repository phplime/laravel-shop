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
        Schema::create('vendor_order_cart_session', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('session_id')->nullable()->index();
            $table->integer('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendor_list')->onDelete('cascade');
            $table->string('order_type')->default('dine_in');

            // Service charge
            $table->string('service_charge_type')->nullable();
            // Rate is usually percentage (e.g., 10.5%), so we multiply by 100 (1050)
            $table->unsignedBigInteger('service_charge_rate')->default(0);
            $table->unsignedBigInteger('service_charge_amount')->default(0); // Amount in cents

            // Tax
            $table->unsignedBigInteger('tax_rate')->default(0); // Rate in cents (e.g., 10.5% = 1050)
            $table->unsignedBigInteger('tax_amount')->default(0); // Amount in cents

            // Tips
            $table->string('tip_type')->nullable(); // flat or percentage
            $table->unsignedBigInteger('tip_rate')->default(0);
            $table->unsignedBigInteger('tip_amount')->default(0);

            // Discount
            $table->string('discount_code')->nullable();
            $table->string('discount_type')->nullable(); // flat or percentage
            $table->unsignedBigInteger('discount_rate')->default(0);
            $table->unsignedBigInteger('discount_amount')->default(0);

            // Totals
            $table->unsignedBigInteger('subtotal')->default(0); // Amount in cents
            $table->unsignedBigInteger('grand_total')->default(0); // Amount in cents

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_order_cart_session');
    }
};
