<?php

declare(strict_types=1);

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
        CategoryFactory::new()->count(6)
            ->withSortingOrder()
            ->create();

        $categories = Category::all();
        $parent_categories = $categories->shift(4);

        $categories->map(function (Category $category) use ($parent_categories) {
            $category->parent_id = $parent_categories->random()->id;
            $category->save();
        });

        CategoryFaqFactory::new()->count(Category::all()->count() * 3)
            ->withSortingOrder()
            ->create();
    }
}
