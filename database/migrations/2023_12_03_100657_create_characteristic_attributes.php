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
        Schema::create('characteristic_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('characteristic_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->tinyInteger('sorting_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characteristic_attributes');
    }
};
