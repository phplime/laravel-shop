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
        Schema::create('vendor_cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('session_id')->nullable()->index();
            $table->integer('vendor_id');
            $table->integer('product_id');
            $table->foreign('vendor_id')->references('id')->on('vendor_list')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('vendor_item_list')->onDelete('cascade');
            $table->string('variant_id')->nullable();
            $table->longText('variants')->nullable();
            $table->integer('quantity')->default(1);
            $table->unsignedBigInteger('price');
            $table->json('options')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'product_id']);
            $table->index(['session_id', 'product_id']);
            $table->index(['vendor_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_cart_items');
    }
};
