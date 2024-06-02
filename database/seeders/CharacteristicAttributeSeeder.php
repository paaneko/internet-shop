<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Characteristic;
use Database\Factories\CharacteristicAttributeFactory;
use Illuminate\Database\Seeder;

class CharacteristicAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $characteristics = Characteristic::all();

        $characteristics->each(function (Characteristic $characteristic) {
            CharacteristicAttributeFactory::new()->count(4)
                ->for($characteristic)
                ->withSortingOrder()
                ->create();
        });
    }
}
