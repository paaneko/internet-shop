<?php

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
        CharacteristicAttributeFactory::new()->count(
            Characteristic::all()->count() * 20
        )
            ->withSortingOrder()
            ->create();
    }
}
