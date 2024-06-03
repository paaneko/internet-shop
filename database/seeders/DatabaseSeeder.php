<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdminUserSeeder::class,

            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            VariationSeeder::class,

            ProductCommentSeeder::class,

            CharacteristicGroupSeeder::class,
            CharacteristicSeeder::class,

            CharacteristicAttributeSeeder::class,

            VariationCharacteristicSeeder::class,

            ProductableSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
