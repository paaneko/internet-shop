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
        Schema::create(
            'variation_characteristics',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('variation_id')
                    ->constrained();
                $table->foreignId('characteristic_id')
                    ->constrained();
                $table->string('sorting_order')->default(0);
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variation_characteristics');
    }
};
