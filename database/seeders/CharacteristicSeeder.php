<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use App\Models\CharacteristicGroup;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $characteristicGroupsIds = CharacteristicGroup::all()->pluck('id')
            ->toArray();

        $faker = Faker::create();

        foreach ($characteristicGroupsIds as $characteristicGroupId) {
            $countOfCharacteristics = $faker->numberBetween(1, 6);
            for ($x = 0; $x < $countOfCharacteristics; $x++) {
                Characteristic::create([
                    'characteristic_group_id' => $characteristicGroupId,
                    // TODO Think about making this column unique
                    'name' => ucfirst($faker->unique()->word()),
                    'hint_text' => $faker->paragraph(2),
                    'is_collapsed' => $faker->boolean,
                ]);
            }
        }
    }
}
