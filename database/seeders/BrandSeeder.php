<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BrandFaq;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory()->count(50)
            ->create(function (array $attributes) {
                return [
                    'slug' => Str::of($attributes['name'])->slug(),
                ];
            });

        BrandFaq::factory(Brand::all()->count() * 3)
            ->state(
                new Sequence(
                    fn (Sequence $sequence
                    ) => ['sorting_order' => $sequence->index]
                )
            )
            ->create();
    }
}
