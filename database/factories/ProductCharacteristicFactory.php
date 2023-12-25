<?php

namespace Database\Factories;

use App\Models\Characteristic;
use App\Models\Product;
use App\Models\ProductCharacteristic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCharacteristic>
 */
class ProductCharacteristicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::all()->pluck('id')->random(),
            'characteristic_id' => Characteristic::all()->pluck('id')->random(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(
            function (ProductCharacteristic $productCharacteristic) {
                $random_attributes = Characteristic::find(
                    $productCharacteristic->characteristic_id
                )->attributes()
                    ->pluck('id');

                if (! empty($random_attributes)) {
                    $productCharacteristic->productAttributes()->attach(
                        $random_attributes
                    );
                }
            }
        );
    }
}
