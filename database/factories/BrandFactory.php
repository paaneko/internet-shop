<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => $name = ucfirst(fake()->word()) . strtoupper(
                fake()->bothify('??')
            ),
            'slug' => Str::of($name)->slug(),
            'meta_tag_h1' => fake()->sentence(4),
            'meta_tag_title' => fake()->sentence(5),
            'meta_tag_description' => fake()->text(150),
            'description' => fake()->text(300),
            'indexation' => fake()->boolean,
        ];
    }

    public function createWithProductRecommendations(): static
    {
        return $this->afterCreating(function (Brand $brand) {
            $brand->productRecommendations()->attach(
                Product::all()->pluck('id')
                    ->random(fake()->numberBetween(1, 6))
            );
        });
    }
}
