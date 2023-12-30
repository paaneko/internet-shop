<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Factories\CategoryFactory;
use Database\Factories\CategoryFaqFactory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryFactory::new()->count(30)
            ->createOptionalWithParentCategory()
            ->withSortingOrder()
            ->create();

        CategoryFaqFactory::new()->count(Category::all()->count() * 3)
            ->withSortingOrder()
            ->create();
    }
}
