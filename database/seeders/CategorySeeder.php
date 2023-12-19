<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryFaq;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(30)
            ->create(function (array $attributes) {
                return [
                    'slug' => Str::of($attributes['name'])->slug(),
                ];
            });

        CategoryFaq::factory(Category::all()->count() * 3)
            ->state(
                new Sequence(
                    fn (Sequence $sequence
                    ) => ['sorting_order' => $sequence->index]
                )
            )
            ->create();
    }
}
