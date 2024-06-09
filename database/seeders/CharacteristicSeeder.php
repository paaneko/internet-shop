<?php

declare(strict_types=1);

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
        CharacteristicFactory::new()->count(10)
            ->withSortingOrder()
            ->create();
    }
}
