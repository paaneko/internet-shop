<?php

declare(strict_types=1);

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
        $name = Str::ucfirst(
            fake()->words(fake()->numberBetween(1, 3), true)
        );

        return [
            'slug' => Str::slug($name) . '-' . fake()->bothify('??????'),
            'name' => $name,
        ];
    }

    public function createWithExistedRandomCharacteristic(): static
    {
        return $this->state(fn (array $attributes) => [
            'characteristic_id' => Characteristic::all()->pluck('id')->random(),
        ]);
    }

    public function createWithProvidedCharacteristicId(
        int $characteristicId
    ): static {
        return $this->state(fn (array $attributes) => [
            'characteristic_id' => $characteristicId,
        ]);
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
