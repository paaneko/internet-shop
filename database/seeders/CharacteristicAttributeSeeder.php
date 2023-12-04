<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use App\Models\CharacteristicAttribute;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CharacteristicAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $characteristicsIds = Characteristic::all()->pluck('id')->toArray();

        $faker = Faker::create();

        foreach ($characteristicsIds as $characteristicId) {
            $countOfCharacteristicAttributes = $faker->optional(
                $weight = 0.6,
                $default = 1
            )->numberBetween(2, 12);
            for ($x = 0; $x < $countOfCharacteristicAttributes; $x++) {
                CharacteristicAttribute::create([
                    'characteristic_id' => $characteristicId,
                    // TODO Think about making this column unique
                    // 🪄 Here starting faker magic 🔮🔮🔮
                    'name' => ucfirst(
                        $faker->word().' '.$faker->optional(
                            0.5,
                            ''
                        )->words($faker->numberBetween(1, 2), true)
                    ),
                    'sorting_order' => $x + 1,
                ]);
            }
        }
    }
}
