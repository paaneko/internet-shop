<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
        ];
    }

    public function withExistingBrand(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'brand_id' => Brand::all()->pluck('id')->random(),
            ];
        });
    }

    public function createWithExistingCategories(): static
    {
        /**
         * With chance 80% attach 1 random category to product.
         * Otherwise, attach 2-6 categories.
         */
        return $this->afterCreating(function (Product $product) {
            $random_categories = fake()->randomElements(
                Category::all()->random()->pluck('id'),
                fake()->optional(0.2, 1)
                    ->numberBetween(2, 6)
            );
            $product->categories()->attach($random_categories);
            $product->save();
        });
    }

    public function createWithExistingOneCategory(): static
    {
        /**
         * Attach 1 random category to product.
         */
        return $this->afterCreating(function (Product $product) {
            $product->categories()->attach(
                Category::all()->random()->pluck('id')
            );
            $product->save();
        });
    }

    public function createWithProductRecommendations(): static
    {
        return $this->afterCreating(function (Product $product) {
            $product->productRecommendations()->attach(
                Product::all()->pluck('id')
                    ->random(fake()->numberBetween(1, 6))
            );
        });
    }
}
