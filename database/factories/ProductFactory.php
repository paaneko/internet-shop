<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => $name = ucfirst(fake()->words(2, true)).' «'.ucfirst(
                fake()->words(2, true)
            )
                .'»',
            'slug' => Str::of($name)->slug(),
            'meta_tag_h1' => fake()->sentence(4),
            'meta_tag_title' => fake()->sentence(5),
            'meta_tag_description' => fake()->text(150),
            'description' => fake()->text(300),
            'product_code' => strtoupper(fake()->bothify('####??')),
            'sku' => strtoupper(fake()->bothify('####??')),
            'upc' => strtoupper(fake()->bothify('????-####')),
            'jan' => fake()->firstNameMale(),
            'mpn' => fake()->isbn13(),
            // 🧠 This statement produce numbers multiples ten
            'price' => intval(
                round(fake()->numberBetween(10, 700) / 10) * 10
            ),
            // 🧠 This statement produce numbers `0` and `1-6` with 50/50 chance
            'count' => fake()->optional($weight = 0.5, $default = 0)
                ->numberBetween(1, 6),
            'status' => 'in-stock',
            'indexation' => fake()->boolean,
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
