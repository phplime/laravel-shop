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
        Schema::create('customer_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('Parent Owner ID');
            $table->unsignedInteger('vendor_id')->nullable();
            $table->string('name', 150)->nullable();
            $table->integer('country_id')->nullable();
            $table->string('dial_code', 10)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 80)->nullable();
            $table->longText('address')->nullable();
            $table->string('location', 255)->nullable();
            $table->string('password', 150)->nullable();
            $table->integer('is_phone_verified')->default(0);
            $table->integer('is_email_verified')->default(0);
            $table->integer('status')->default(1);
            $table->string('otp', 10)->nullable();
            $table->string('last_attempt_at', 50)->nullable();
            $table->string('otp_expire_time', 50)->nullable();
            $table->integer('attempts')->nullable();
            $table->string('profile', 100)->nullable();
            $table->string('role', 15)->default('customer');
            $table->double('wallet_bal', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_list');
    }
};
