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
        Schema::create('vendor_coupon_list', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendor_list')->onDelete('cascade');

            $table->string('code', 100)->nullable()->unique();
            $table->string('type', 100)->nullable();

            // Value stored in smallest currency unit (e.g., cents: $10.50 -> 1050)
            $table->unsignedBigInteger('value')->default(0);
            $table->string('value_type', 100)->nullable();
            // Minimum order amount stored in cents
            $table->unsignedBigInteger('min_order_amount')->default(0);

            $table->integer('usage_limit')->nullable();
            $table->integer('used_count')->default(0);

            $table->boolean('is_active')->default(true);
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_coupon_list');
    }
};
