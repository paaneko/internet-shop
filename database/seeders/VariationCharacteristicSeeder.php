<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Variation;
use App\Models\VariationCharacteristic;
use Illuminate\Database\Seeder;

class VariationCharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VariationCharacteristic::factory()->count(Variation::all()->count() * 5)
            ->createWithRandomAttributes()
            ->create();
    }
}
