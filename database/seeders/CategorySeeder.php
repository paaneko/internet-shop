<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categoriesList = [
            [
                'name' => 'Bongs',
                'parent_id' => null,
            ],
            [
                'name' => 'Vaporizers',
                'parent_id' => null,
            ],
            [
                'name' => 'Grinders',
                'parent_id' => null,
            ],
            [
                'name' => 'Hookahs',
                'parent_id' => null,
            ],
            [
                'name' => 'Thimbles, smoking caps',
                'parent_id' => null,
            ],
            [
                'name' => 'Pipes for smoking weed',
                'parent_id' => null,
            ],
            [
                'name' => 'Bong Accessories',
                'parent_id' => null,
            ],
            [
                'name' => 'Bong Adapters',
                'parent_id' => 7,
            ],
            [
                'name' => 'Bong Parts',
                'parent_id' => 7,
            ],
            [
                'name' => 'Bong Thimbles',
                'parent_id' => 7,
            ],
            [
                'name' => 'Bong pre-coolers',
                'parent_id' => 7,
            ],
            [
                'name' => 'Bong nets',
                'parent_id' => 7,
            ],
            [
                'name' => 'Bong tuning',
                'parent_id' => 7,
            ],
            [
                'name' => 'Bong peels',
                'parent_id' => 7,
            ],
            [
                'name' => 'Vaporizer Accessories',
                'parent_id' => null,
            ],
            [
                'name' => 'Batteries for vaporizers',
                'parent_id' => 14,
            ],
            [
                'name' => 'Vaporizer Parts',
                'parent_id' => 14,
            ],
            [
                'name' => 'Vaporizer Chargers',
                'parent_id' => 14,
            ],
            [
                'name' => 'Vaporizer Cleaning Tools',
                'parent_id' => 14,
            ],
            [
                'name' => 'Vaporizer chambers',
                'parent_id' => 14,
            ],
            [
                'name' => 'Vaporizer capsules',
                'parent_id' => 14,
            ],
            [
                'name' => 'Vaporizer bags',
                'parent_id' => 14,
            ],
            [
                'name' => 'Mouthpieces for vaporizers',
                'parent_id' => 14,
            ],
            [
                'name' => 'Vaporizer kits',
                'parent_id' => 14,
            ],
            [
                'name' => 'Vaporizer adapters',
                'parent_id' => 14,
            ],
            [
                'name' => 'Vaporizer stands',
                'parent_id' => 14,
            ],
            [
                'name' => 'Grids and filters for vaporizers',
                'parent_id' => 14,
            ],
            [
                'name' => 'Seals for vaporizers',
                'parent_id' => 14,
            ],
            [
                'name' => 'Heating devices for vaporizers',
                'parent_id' => 14,
            ],
            [
                'name' => 'Hoses for vaporizers',
                'parent_id' => 14,
            ],

            [
                'name' => 'Hookah Accessories',
                'parent_id' => null,
            ],
            [
                'name' => 'Hookah Parts',
                'parent_id' => 32,
            ],
            [
                'name' => 'Hookah Cauldrons',
                'parent_id' => 32,
            ],
            [
                'name' => 'Hookah flasks',
                'parent_id' => 32,
            ],
            [
                'name' => 'Baskets for coals',
                'parent_id' => 32,
            ],
            [
                'name' => 'Water dyes for hookah flask',
                'parent_id' => 32,
            ],
            [
                'name' => 'Melasso traps',
                'parent_id' => 32,
            ],
            [
                'name' => 'Mouthpieces for hookah',
                'parent_id' => 32,
            ],
            [
                'name' => 'Charcoal stoves',
                'parent_id' => 32,
            ],
            [
                'name' => 'Coal for hookah',
                'parent_id' => 32,
            ],
            [
                'name' => 'Sealants for hookah',
                'parent_id' => 32,
            ],
            [
                'name' => 'Hookah foil',
                'parent_id' => 32,
            ],
            [
                'name' => 'Hookah bowls',
                'parent_id' => 32,
            ],
            [
                'name' => 'Hoses for hookah',
                'parent_id' => 32,
            ],
            [
                'name' => 'Hookah tongs',
                'parent_id' => 32,
            ],
        ];

        foreach ($categoriesList as $category) {
            // Generate slug by replacing spaces with hyphens
            $slug = strtolower(str_replace(' ', '-', $category['name']));
            Category::create([
                'parent_id' => $category['parent_id'],
                'name' => $category['name'],
                'slug' => $slug,
                'meta_tag_h1' => $faker->sentence(4),
                'meta_tag_title' => $faker->sentence(5),
                'meta_tag_description' => $faker->text(150),
                'description' => $faker->text(300),
                'indexation' => $faker->boolean,
            ]);
        }
    }
}
