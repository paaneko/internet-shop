<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\CharacteristicGroupFactory;
use Illuminate\Database\Seeder;

class CharacteristicGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CharacteristicGroupFactory::new()->count(3)
            ->withSortingOrder()
            ->create();
    }
}
