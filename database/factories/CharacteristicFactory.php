<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CharacteristicGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Characteristic>
 */
class CharacteristicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'characteristic_group_id' => CharacteristicGroup::all()
                ->pluck('id')->random(),
            'name' => ucfirst(fake()->words(2, true)),
            'hint_text' => fake()->optional()->sentence(),
            'is_collapsed' => fake()->boolean,
        ];
    }
}
