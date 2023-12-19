<?php

namespace Database\Factories;

use App\Models\Characteristic;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => fake()->word,
        ];
    }
}
