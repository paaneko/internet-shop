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
        CharacteristicAttributeFactory::new()->count(
            Characteristic::all()->count() * 2
        )
            ->withSortingOrder()
            ->create();
    }
}
