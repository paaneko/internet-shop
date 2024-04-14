<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variation>
 */
class VariationFactory extends Factory
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
            'ean' => fake()->isbn13(),
            'mpn' => fake()->isbn13(),
            // 🧠 This statement produce numbers multiples ten
            'price' => intval(
                round(fake()->numberBetween(10, 700) / 10) * 10
            ),
            // 🧠 This statement produce numbers `0` and `1-6` with 50/50 chance
            'count' => fake()->optional($weight = 0.5, $default = 0)
                ->numberBetween(1, 6),
            'color' => fake()->hexColor,
            'indexation' => fake()->boolean,
        ];
    }

    public function createWithCreatedProductWithProvidedCategory(
        Category $category
    ): static {
        return $this->state(fn (array $attributes) => [
            'product_id' => ProductFactory::new()
                ->hasAttached($category)
                ->create(),
        ]);
    }

    public function createWithRandomProduct(): static
    {
        return $this->state(fn (array $attributes) => [
            'product_id' => Product::all()->pluck('id')->random(),
        ]);
    }

    public function createWithRandomCreatedProduct(): static
    {
        return $this->state(fn (array $attributes) => [
            'product_id' => ProductFactory::new()->create(),
        ]);
    }

    public function createWithMedia(): static
    {
        return $this->afterCreating(function (Variation $product) {
            $media_path = storage_path('fake-media/product/').fake()
                ->numberBetween(
                    1,
                    13
                ).'.jpg';

            $product->addMedia($media_path)
                ->preservingOriginal()
                ->toMediaCollection('default', 'media-product');
        });
    }
}
