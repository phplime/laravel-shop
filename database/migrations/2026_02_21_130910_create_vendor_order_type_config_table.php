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
        Schema::create('vendor_order_type_config', function (Blueprint $table) {
            $table->id();
            $table->string('order_type')->unique();
            $table->string('label');
            $table->string('service_charge_type')->nullable();
            $table->unsignedBigInteger('service_charge_rate')->default(0);
            $table->unsignedBigInteger('tax_rate')->default(0);
            $table->boolean('tips_enabled')->default(false);
            $table->boolean('status')->default(true);
            $table->boolean('is_admin_enabled')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_order_type_config');
    }
};
