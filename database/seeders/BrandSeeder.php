<?php

namespace Database\Seeders;

use App\Models\Brand;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $brandsList = [
            '420UA',
            '4Smoke',
            '5MM',
            '7Pipe',
            '@head',
            'Actitube',
            'Adventure',
            'After Grow',
            'Airistech',
            'AirVape',
            'Al-Fakher',
            'Aldo Morelli',
            'AMO',
            'Amsterdam',
            'AMY',
            'Anaxy',
            'Angel',
            'Angelo',
            'Arabisq',
            'Arc cigarette',
            'Arizer',
            'AroMed',
            'Atlas',
            'Atman',
            'AtmosRx',
            'Atomic',
            'B&B',
            'Bafa',
            'Bambu',
            'Baseus',
            'Bent',
            'Better Bat',
            'Big-Ben',
            'Black Leaf',
            'Black Lion',
            'Blaze Glass',
            'Blitz',
            'Blomus',
            'BLscale',
            'Blunt Wrap',
            'BMIC Tech',
            'Bob Marley Papers',
            'Bong Master',
            'Boost',
            'Boost Pro',
            'Boundless',
            'Boveda',
            'BPK',
            'Breit',
            'Breitseite',
            'Brifit',
            'Broad',
            'Bud Bug',
            'Budbomb',
            'BudBoy',
            'Buho',
            'Bulldog',
            'Bullfrog',
            'Cactus',
            'Calumet',
            'Camel',
            'Cannabuds',
            'Cannasseur',
            'CANNAX',
            'Carbopol',
            'Cartel',
            'Champ High',
            'Cheech & Chong',
            'Cheekyone',
            'Chewy',
            'Choosypapers',
            'Clipper',
            'Cloudious9',
            'Cocobrico',
            'Cocoloco',
            'Coffeein Clean Hookah',
            'Cohiba',
            'Colton',
            'Comics Ghost',
            'Coney',
            'Cournot',
            'Cozy Neptun',
            'CrafTech',
            'Crown',
            'Crystal',
            'Cyclones',
            'D&K Dengke',
            'DaVinci',
            'Deluxe Daddy',
            'Denicotea',
            'Dexso',
            'Diamond Haze',
            'Discreet Vape',
            'Don Marko',
            'Dope Bros',
            'DUD',
            'DuDa',
            'Dude',
            'Dutch',
            'DynaVap',
        ];

        foreach ($brandsList as $brand) {
            // Generate slug by replacing spaces with hyphens
            $slug = strtolower(str_replace(' ', '-', $brand));
            Brand::create([
                'name' => $brand,
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
