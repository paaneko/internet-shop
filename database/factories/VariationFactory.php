<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Variation;
use Faker\Factory as Faker;
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
            'name' => $name = ucfirst(fake()->words(2, true)) . ' «' . ucfirst(
                fake()->words(2, true)
            )
                . '»',
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
                $price = round(fake()->numberBetween(200, 1700) / 10) * 10
            ),
            // Adds 50% chance of returning 0
            'old_price' => intval(
                (fake()->numberBetween(0, 1) === 0)
                    ? 0
                    : (
                        $price - round(
                            fake()->numberBetween(10, 100) / 10
                        ) * 10
                    )
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
            $media_path = storage_path('fake-media/product/') . fake()
                ->numberBetween(
                    1,
                    13
                ) . '.jpg';

            $product->addMedia($media_path)
                ->preservingOriginal()
                ->toMediaCollection('default', 'media-product');
        });
    }

    /** Fuction for generating fake description  */
    public static function generateHtmlContent()
    {
        $faker = Faker::create();
        $html = '';

        // Detailed Product Description
        $html .= '<p>' . $faker->text(300) . '</p>';
        $html .= '<p>' . $faker->paragraph(4) . '</p>';
        $html .= '<p>' . $faker->paragraph(5) . '</p>';

        // Section: Product Features
        $html .= '<div class="font-semibold text-xl">Product Features</div>';
        $html .= '<ul class="">';
        for ($o = 0; $o < $faker->numberBetween(4, 8); $o++) {
            $html .= '<li>' . $faker->sentence . '</li>';
        }
        $html .= '</ul>';

        // Section: Additional Information
        $html .= '<div class="font-semibold text-xl">Additional Information</div>';
        $html .= '<p>' . $faker->paragraph(10) . '</p>';

        // Section: Package Contents
        $html .= '<div class="font-semibold text-xl">Package Contents</div>';
        $html .= '<ul>';
        for ($i = 0; $i < $faker->numberBetween(5, 10); $i++) {
            $html .= '<li><b>' . $faker->sentence . '</b> – ' . $faker->numberBetween(1, 3) . ' ' . $faker->word . '</li>';
        }
        $html .= '</ul>';

        // Section: Design and Build Quality
        $html .= '<div class="font-semibold text-xl">Design and Build Quality</div>';
        $html .= '<p>' . $faker->paragraph(4) . '</p>';
        $html .= '<p>' . $faker->paragraph(6) . '</p>';

        // Section: Dimensions
        $html .= '<div class="font-semibold text-xl">Dimensions</div>';
        $html .= '<p>' . $faker->text(500) . '</p>';

        return $html;
    }
}
