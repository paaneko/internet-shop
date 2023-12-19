<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /**
         * Columns: slug
         *
         * Was implemented in Seeder
         *
         * @see database/seeders/BrandSeeder.php
         */
        return [
            'name' => ucfirst(fake()->word()).strtoupper(fake()->bothify('??')),
            'meta_tag_h1' => fake()->sentence(4),
            'meta_tag_title' => fake()->sentence(5),
            'meta_tag_description' => fake()->text(150),
            'description' => fake()->text(300),
            'indexation' => fake()->boolean,
        ];
    }
}
