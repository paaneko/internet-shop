<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CharacteristicGroup>
 */
class CharacteristicGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst(
                fake()->optional(
                    0.3,
                    fake()->word()
                )->words(2, true)
            ).'Group',
        ];
    }
}
