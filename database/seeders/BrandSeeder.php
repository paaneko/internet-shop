<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Brand;
use Database\Factories\BrandFactory;
use Database\Factories\BrandFaqFactory;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BrandFactory::new()->count(50)
            ->create();

        BrandFaqFactory::new()->count(Brand::all()->count() * 3)
            ->withSortingOrder()
            ->create();
    }
}
