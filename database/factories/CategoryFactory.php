<?php

namespace Database\Factories;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
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

    public function createOptionalWithParentCategory(): static
    {
        return $this->afterCreating(function (Category $category) {
            /**
             * Make 66% of all columns children of random parent column
             */
            if ($category->id % 3) {
                $category->parent_id = Category::all()
                    ->where('parent_id', null)
                    ->random()->id;
                $category->save();
            }
        });
    }
}
