<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use Database\Factories\VariationFactory;
use Illuminate\Database\Seeder;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VariationFactory::new()->count(Product::all()->count() * 5)
            ->createWithRandomProduct()
            ->createWithMedia()
            ->create();
    }
}
