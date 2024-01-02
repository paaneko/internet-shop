<?php

namespace Database\Seeders;

use App\Models\Product;
use Database\Factories\ProductCommentFactory;
use Illuminate\Database\Seeder;

class ProductCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCommentFactory::new()->count(Product::count() * 3)
            ->create();
    }
}
