<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Characteristic;
use App\Models\Variation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VariationCharacteristic>
 */
class VariationCharacteristicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'variation_id' => Variation::all()->pluck('id')->random(),
            'characteristic_id' => Characteristic::all()->pluck('id')->random(),
        ];
    }
}
