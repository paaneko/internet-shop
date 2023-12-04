<?php

namespace Database\Seeders;

use App\Models\CharacteristicGroup;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CharacteristicGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $characteristicGroupList = [
            ['name' => 'Platform'],
            ['name' => 'Adapter'],
            ['name' => 'Battery'],
            ['name' => 'Saucer'],
            ['name' => 'Display'],
            ['name' => 'Extras'],
            ['name' => 'Interfaces'],
            ['name' => 'Flask'],
            ['name' => 'Body'],
            ['name' => 'Tape'],
            ['name' => 'Mouthpiece'],
            ['name' => 'Thimble'],
            ['name' => 'General information'],
            ['name' => 'Features'],
            ['name' => 'Coal Size'],
            ['name' => 'Dimensions'],
            ['name' => 'Specifications'],
            ['name' => 'Filter'],
            ['name' => 'Bowl'],
            ['name' => 'Shaft'],
            ['name' => 'Hose'],
            ['name' => 'Screed'],
        ];

        // TODO think about making sorting_order value unique
        foreach ($characteristicGroupList as $characteristicGroup) {
            CharacteristicGroup::create([
                'name' => $characteristicGroup['name'],
                'sorting_order' => $faker->unique()->numberBetween(
                    1,
                    count($characteristicGroupList)
                ),
            ]);
        }
    }
}
