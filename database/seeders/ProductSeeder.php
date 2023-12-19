<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductFaq;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->count(50)
            ->state(
                new Sequence(
                    fn (Sequence $sequence) => [
                        'brand_id' => Brand::all()->random(),
                    ]
                )
            )
            ->create(function (array $attributes) {
                return [
                    'slug' => Str::of($attributes['name'])->slug(),
                ];
            });

        ProductFaq::factory(Product::all()->count() * 3)
            ->state(
                new Sequence(
                    fn (Sequence $sequence
                    ) => ['sorting_order' => $sequence->index]
                )
            )
            ->create();
    }
}
