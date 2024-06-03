<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Database\Factories\ProductFaqFactory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductFactory::new()->count(10)
            ->createWithExistingCategories()
            ->create();

        ProductFaqFactory::new()->count(Product::all()->count() * 3)
            ->createWithSortingOrder()
            ->create();
    }
}
