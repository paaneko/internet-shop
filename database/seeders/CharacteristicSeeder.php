<?php

namespace Database\Seeders;

use Database\Factories\CharacteristicFactory;
use Illuminate\Database\Seeder;

class CharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CharacteristicFactory::new()->count(150)
            ->withSortingOrder()
            ->create();
    }
}
