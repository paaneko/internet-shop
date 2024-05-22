<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\AdminUserFactory;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminUserFactory::new()->create([
            'email' => 'paaneko@gmail.com',
            'password' => 'root',
        ]);
    }
}
