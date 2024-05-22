<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class ProductableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * This foreach loops attach random products to table `productables`,
         * for these models:
         * - Brand
         * - Product
         * - Categories
         *
         * The reason I create this seeder is to handle the case where certain seeders,
         * like BrandSeeder, execute before ProductSeeder. This ensures that productables
         * can't be attached directly in the seeder or factory.
         *
         * FIXME Maybe it can cause problems with testing
         *
         * @see Brand::productRecommendations
         */
        self::attachProductRecommendationsToCollection(Brand::all());
        self::attachProductRecommendationsToCollection(Product::all());
        self::attachProductRecommendationsToCollection(Category::all());
    }

    /**
     * Attach random product recommendations to the given collection.
     *
     * This method is used to populate the `productRecommendations` pivot table
     * for models that have a many-to-many relationship with products.
     */
    private function attachProductRecommendationsToCollection(
        Collection $collection
    ): void {
        foreach ($collection as $category) {
            $category->productRecommendations()->attach(
                Product::all()->pluck('id')
                    ->random(fake()->numberBetween(1, 6))
            );
        }
    }
}
