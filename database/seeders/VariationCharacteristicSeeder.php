<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Characteristic;
use App\Models\Variation;
use Database\Factories\VariationCharacteristicFactory;
use Illuminate\Database\Seeder;

class VariationCharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variations = Variation::all()->pluck('id');

        $variations->each(function (int $variation_id) {
            $characteristics = Characteristic::all()->random(5);

            $characteristics->each(function (Characteristic $characteristic) use ($variation_id) {
                $variationCharacteristic = VariationCharacteristicFactory::new()
                    ->create([
                        'variation_id' => $variation_id,
                        'characteristic_id' => $characteristic->id,
                    ]);

                $attributes = $characteristic->attributes
                    ->random(fake()->numberBetween(1, 4))->pluck('slug');

                $variationCharacteristic->variationAttributes()
                    ->attach($attributes);

            });
        });
    }
}
