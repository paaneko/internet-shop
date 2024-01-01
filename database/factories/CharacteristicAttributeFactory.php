<?php

namespace Database\Factories;

use App\Models\Characteristic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CharacteristicAttribute>
 */
class CharacteristicAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'characteristic_id' => Characteristic::all()->pluck('id')->random(),
            'name' => Str::ucfirst(
                fake()->words(fake()->numberBetween(1, 3), true)
            ),
        ];
    }

    public function withSortingOrder(): static
    {
        return $this->state(
            new Sequence(
                fn (Sequence $sequence
                ) => ['sorting_order' => $sequence->index + 1]
            )
        );
    }
}
