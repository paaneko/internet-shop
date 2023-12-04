<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $productsList = [
            [
                'name' => 'Crystal Cascade Bong',
            ],
            [
                'name' => 'NovaVape Pro Vaporizer',
            ],
            [
                'name' => 'Diamond Grind Grinder',
            ],
            [
                'name' => 'MysticHookah Deluxe',
            ],
            [
                'name' => 'Velvet Smoke Thimble',
            ],
            [
                'name' => 'ZenPipe Classic',
            ],
            [
                'name' => 'AquaBreeze Bong Adapter',
            ],
            [
                'name' => 'TitaniumBlast Bong Part',
            ],
            [
                'name' => 'GlassGlide Bong Thimble',
            ],
            [
                'name' => 'IceFusion Bong Pre-cooler',
            ],
            [
                'name' => 'ZenMesh Bong Net',
            ],
            [
                'name' => 'EcoTune Bong Tuning Kit',
            ],
            [
                'name' => 'CitrusPeel Bong Peel',
            ],
            [
                'name' => 'EcoPower Batteries for Vaporizers',
            ],
            [
                'name' => 'QuantumFlow Vaporizer Parts',
            ],
            [
                'name' => 'RapidCharge Vaporizer Charger',
            ],
            [
                'name' => 'PureClean Vaporizer Cleaning Tools',
            ],
            [
                'name' => 'AeroChamber Vaporizer',
            ],
            [
                'name' => 'ElixirCaps Vaporizer Capsules',
            ],
            [
                'name' => 'VaporSack Vaporizer Bag',
            ],
            [
                'name' => 'EleganceMist Mouthpiece',
            ],
            [
                'name' => 'EliteVape Kit',
            ],
            [
                'name' => 'FlexAdapter Vaporizer Adapter',
            ],
            [
                'name' => 'ZenStance Vaporizer Stand',
            ],
            [
                'name' => 'PurityGrid Vaporizer Grid',
            ],
            [
                'name' => 'SiliconeSeal Vaporizer Seal',
            ],
            [
                'name' => 'HeatCraft Vaporizer Heater',
            ],
            [
                'name' => 'SilkStream Vaporizer Hose',
            ],
            [
                'name' => 'MysticHookah Accessories Kit',
            ],
            [
                'name' => 'HookahMaster Hookah Parts',
            ],
            [
                'name' => 'CauldronCraft Hookah Cauldron',
            ],
            [
                'name' => 'CrystalFlask Hookah Flask',
            ],
            [
                'name' => 'CoalBasket Hookah Basket',
            ],
            [
                'name' => 'AquaDye Hookah Water Dye',
            ],
            [
                'name' => 'MelloTrap Hookah Melasso Trap',
            ],
            [
                'name' => 'EleganceTip Hookah Mouthpiece',
            ],
            [
                'name' => 'CharcoalBlaze Hookah Stove',
            ],
            [
                'name' => 'GoldCoal Hookah Coal',
            ],
            [
                'name' => 'PerfectSeal Hookah Sealant',
            ],
            [
                'name' => 'SilverFoil Hookah Foil',
            ],
            [
                'name' => 'MysticBowl Hookah Bowl',
            ],
            [
                'name' => 'SilkStream Hookah Hose',
            ],
            [
                'name' => 'GoldenTongs Hookah Tongs',
            ],
        ];

        $products = [];

        foreach ($productsList as $product) {
            // Generate slug by replacing spaces with hyphens
            $slug = strtolower(str_replace(' ', '-', $product['name']));
            // ⚠️ Columns 'product_code' and 'SKU' must have same values
            $sku = strtoupper($faker->bothify('####??'));
            /*
             * TODO Update seeder logic
             * Work: Delete status column
             */
            $products[] = [
                // 🚨 range numberBetween() must represent actual count of brands from BrandSeeder
                'brand_id' => $faker->numberBetween(1, 100),
                'name' => $product['name'],
                'slug' => $slug,
                'meta_tag_h1' => $faker->sentence(4),
                'meta_tag_title' => $faker->sentence(5),
                'meta_tag_description' => $faker->text(150),
                'description' => $faker->text(300),
                'product_code' => $sku,
                'SKU' => $sku,
                'UPC' => strtoupper($faker->bothify('????-####')),
                'JAN' => $faker->firstName(
                    $gender = 'male'
                ),
                'MPN' => $faker->isbn13(),
                // FIXME after implementing moneyCast feature this value should be float type
                'price' => intval(
                    round($faker->numberBetween(10, 700) / 10) * 10
                ),
                // 🧠 big amount of products have one quantity
                // TODO change in migration and model `count` on `qty` or `quantity`
                'count' => $faker->optional($weight = 0.5, $default = 1)->numberBetween(2, 6),
                'status' => 'in-stock',
                'indexation' => $faker->boolean,
            ];

            DB::table('products')->insert($products);
        }
    }
}
