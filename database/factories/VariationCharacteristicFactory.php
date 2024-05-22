<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Characteristic;
use App\Models\Variation;
use App\Models\VariationCharacteristic;
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

    public function createWithRandomAttributes(): static
    {
        return $this->afterCreating(
            function (VariationCharacteristic $variationCharacteristic) {
                $random_attributes = Characteristic::find(
                    $variationCharacteristic->characteristic_id
                )->attributes()
                    ->pluck('id');

                if (! $random_attributes->isEmpty()) {
                    $variationCharacteristic->variationAttributes()->attach(
                        $random_attributes->random(
                            fake()->optional(0.1, 1)->numberBetween(
                                1,
                                round($random_attributes->count() / 2)
                            )
                        )
                    );
                }
            }
        );
    }
}
