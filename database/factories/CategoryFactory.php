<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /**
         * Columns: parent_id, slug
         *
         * Were implemented in Seeder
         *
         * @see database/seeders/CategorySeeder.php
         */
        return [
            'name' => $name = strtoupper(
                fake()
                    ->optional(0.6, fake()->word)
                    ->words(2, true)
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
        return $this->afterCreating(function (Category $category) {
            $category->productRecommendations()->attach(
                Product::all()->pluck('id')
                    ->random(fake()->numberBetween(1, 6))
            );
        });
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
