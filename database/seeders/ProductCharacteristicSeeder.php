<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCharacteristic;
use Illuminate\Database\Seeder;

class ProductCharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCharacteristic::factory()->count(Product::all()->count() * 20)
            ->create();
    }
}
