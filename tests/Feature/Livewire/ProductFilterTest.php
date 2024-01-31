<?php

use App\Livewire\Pages\ProductFilter;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\ProductCharacteristic;
use Database\Factories\CategoryFactory;
use Database\Factories\CharacteristicAttributeFactory;
use Database\Factories\CharacteristicFactory;
use Database\Factories\CharacteristicGroupFactory;
use Database\Factories\ProductFactory;
use Illuminate\Support\Str;

it('can render page', function () {
    $category = CategoryFactory::new()->create();

    Livewire::test(ProductFilter::class, ['url' => $category->slug])
        ->assertStatus(200);
});

it('can display one product in category', function () {
    $category = CategoryFactory::new()->create();

    $product = ProductFactory::new()
        ->hasAttached([$category])
        ->create();
    //    CharacteristicGroupFactory::new()->count(3)
    //        ->withSortingOrder()
    //        ->create();
    //    CharacteristicFactory::new()->count(5)
    //        ->withSortingOrder()
    //        ->create();
    //    CharacteristicAttributeFactory::new()->count(
    //        Characteristic::all()->count() * 2
    //    )
    //        ->withSortingOrder()
    //        ->create();
    //    ProductCharacteristic::factory()->count(5)
    //        ->create();
    //    dd(\App\Models\Product::first()->categories->first()->name);
    //    dd(Category::all()->count());
    Livewire::test(ProductFilter::class, ['url' => $category->slug])
        ->assertSee($product->name);
});

it('can display list products in category', function () {
    $category = CategoryFactory::new()->create();

    $products = ProductFactory::new()
        ->count(8)
        ->hasAttached([$category])
        ->create()
        ->pluck('name')
        ->toArray();

    Livewire::test(ProductFilter::class, ['url' => $category->slug])
        ->assertSeeInOrder($products);
});

it('can display products in different categories', function () {
    $firstCategory = CategoryFactory::new()->create();
    $secondCategory = CategoryFactory::new()->create();

    $firstCategoryProducts = ProductFactory::new()
        ->count(4)
        ->hasAttached([$firstCategory])
        ->create()
        ->pluck('name');

    $secondCategoryProducts = ProductFactory::new()
        ->count(4)
        ->hasAttached([$secondCategory])
        ->create()
        ->pluck('name');

    Livewire::test(ProductFilter::class, ['url' => $firstCategory->slug])
        ->assertSeeInOrder($firstCategoryProducts->toArray())
        ->assertDontSee($secondCategoryProducts->first());

    Livewire::test(ProductFilter::class, ['url' => $secondCategory->slug])
        ->assertSeeInOrder($secondCategoryProducts->toArray())
        ->assertDontSee($firstCategoryProducts->first());
});

it('can filter products in category', function () {
    $category = CategoryFactory::new()->create();

    $products = ProductFactory::new()
        ->count(2)
        ->hasAttached([$category])
        ->create();

    $productWithoutCategory = ProductFactory::new()
        ->create();

    CharacteristicGroupFactory::new()->count(3)
        ->withSortingOrder()->create();

    $characteristics = CharacteristicFactory::new()->count(2)->withSortingOrder(
    )->create();

    $attributes = CharacteristicAttributeFactory::new()->count(2)
        ->withSortingOrder()->create();

    foreach ($products as $index => $product) {
        $productCharacteristic = ProductCharacteristic::factory()
            ->for($product)
            ->for($characteristics[$index])
            ->create();

        $productCharacteristic->productAttributes()->attach(
            $attributes[$index]
        );
    }

    Livewire::test(
        ProductFilter::class,
        ['url' => $category->slug.'/'.Str::slug($attributes[0]->name)]
    )
        ->assertSee($products[0]->name)
        ->assertDontSee($products[1]->name)
        ->assertDontSee($productWithoutCategory);

    Livewire::test(
        ProductFilter::class,
        ['url' => $category->slug.'/not_existing_attribute_slug']
    )
        ->assertSee($products[0]->name)
        ->assertSee($products[1]->name)
        ->assertDontSee($productWithoutCategory);

    Livewire::test(ProductFilter::class, [
        'url' => $category->slug.'/not_existing_attribute_slug/'.Str::slug(
            $attributes[0]->name
        ),
    ])
        ->assertSee($products[0]->name)
        ->assertDontSee($products[1]->name)
        ->assertDontSee($productWithoutCategory);
});
