<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all existing category and product IDs
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $productIds = DB::table('products')->pluck('id')->toArray();

        foreach ($productIds as $productId) {
            $numberOfCategories = $faker->numberBetween(2, 5);
            // Generate a random number to determine if the product has one or multiple categories
            $isSingleCategory = $faker->boolean(70);

            // Randomly choose categories
            $randomCategoryIds = $isSingleCategory
                ? [$faker->randomElement($categoryIds)]
                : $faker->randomElements($categoryIds, $numberOfCategories);

            foreach ($randomCategoryIds as $categoryId) {
                DB::table('category_product')->insert([
                    'category_id' => $categoryId,
                    'product_id' => $productId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
