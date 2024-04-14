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
        Schema::create(
            'variation_characteristic_attributes',
            function (Blueprint $table) {
                $table->primary(
                    [
                        'variation_characteristic_id',
                        'characteristic_attribute_id',
                    ]
                );
                $table->foreignId('variation_characteristic_id')->nullable()
                    ->constrained();
                $table->foreignId('characteristic_attribute_id')->nullable()
                    ->constrained();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variation_characteristic_attributes');
    }
};
