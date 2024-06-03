<?php

declare(strict_types=1);

use App\Models\VariationCharacteristic;
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
        Schema::create('variation_characteristic_attributes', function (Blueprint $table) {
            $table->primary([
                (new VariationCharacteristic())->getForeignKey(),
                'characteristic_attribute_slug',
            ]);

            $table->foreignIdFor(VariationCharacteristic::class)
                ->nullable()
                ->constrained();
            $table->foreignId('characteristic_attribute_slug')
                ->type('string')
                ->nullable()
                ->constrained('characteristic_attributes', 'slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variation_characteristic_attributes');
    }
};
