<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use App\Models\CharacteristicAttribute;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CharacteristicAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CharacteristicAttribute::factory()->count(
            Characteristic::all()->count() * 3
        )
            ->state(
                new Sequence(
                    fn (Sequence $sequence
                    ) => ['sorting_order' => $sequence->index]
                )
            )
            ->create();
    }
}
