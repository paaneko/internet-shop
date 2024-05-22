<?php

declare(strict_types=1);

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('order_number')->unique();
            $table->string('stripe_checkout_session_id')->unique();
            $table->integer('amount_shipping')->default(0);
            $table->integer('amount_discount')->default(0);
            $table->integer('amount_subtotal')->default(0);
            $table->integer('amount_total')->default(0);
            $table->json('billing_address');
            $table->json('shipping_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
