<?php

namespace Database\Seeders;

use App\Models\CharacteristicGroup;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CharacteristicGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CharacteristicGroup::factory()->count(25)
            ->state(
                new Sequence(
                    fn (Sequence $sequence
                    ) => ['sorting_order' => $sequence->index + 1]
                )
            )->create();
    }
}
