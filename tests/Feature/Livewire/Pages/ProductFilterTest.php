<?php

declare(strict_types=1);

use App\Livewire\Pages\CategoryFilter;
use App\Models\VariationCharacteristic;
use Database\Factories\CategoryFactory;
use Database\Factories\CharacteristicAttributeFactory;
use Database\Factories\CharacteristicFactory;
use Database\Factories\CharacteristicGroupFactory;
use Database\Factories\ProductFactory;
use Database\Factories\VariationFactory;
use Illuminate\Support\Str;

it('can render page', function () {
    $category = CategoryFactory::new()->create();

    Livewire::test(CategoryFilter::class, ['url' => $category->slug])
        ->assertStatus(200);
});

it('can display one variation in category', function () {
    $category = CategoryFactory::new()->create();

    $product = ProductFactory::new()
        ->hasAttached([$category])
        ->create();

    $variation = VariationFactory::new()->state(
        ['product_id' => $product]
    )->create();

    Livewire::test(CategoryFilter::class, ['url' => $category->slug])
        ->assertSee($variation->name);
});

it('can display list of variations in category', function () {
    $category = CategoryFactory::new()->create();

    $variations = VariationFactory::new()
        ->count(8)
        ->createWithCreatedProductWithProvidedCategory($category)
        ->create()
        ->pluck('name')
        ->toArray();

    Livewire::test(CategoryFilter::class, ['url' => $category->slug])
        ->assertSeeInOrder($variations);
});

it('can display variations in different categories', function () {
    $firstCategory = CategoryFactory::new()->create();
    $secondCategory = CategoryFactory::new()->create();

    $firstCategoryVariation = VariationFactory::new()
        ->count(8)
        ->createWithCreatedProductWithProvidedCategory($firstCategory)
        ->create()
        ->pluck('name');

    $secondCategoryVariation = VariationFactory::new()
        ->count(8)
        ->createWithCreatedProductWithProvidedCategory($secondCategory)
        ->create()
        ->pluck('name');

    Livewire::test(CategoryFilter::class, ['url' => $firstCategory->slug])
        ->assertSeeInOrder($firstCategoryVariation->toArray())
        ->assertDontSee($secondCategoryVariation->first());

    Livewire::test(CategoryFilter::class, ['url' => $secondCategory->slug])
        ->assertSeeInOrder($secondCategoryVariation->toArray())
        ->assertDontSee($firstCategoryVariation->first());
});

it('can filter variations in category', function () {
    $category = CategoryFactory::new()->create();

    $variations = VariationFactory::new()
        ->count(2)
        ->createWithCreatedProductWithProvidedCategory($category)
        ->create();

    $variationWithoutCategory = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    CharacteristicGroupFactory::new()->count(3)
        ->withSortingOrder()
        ->create();

    $characteristics = CharacteristicFactory::new()->count(2)
        ->withSortingOrder()
        ->create();

    $attributes = CharacteristicAttributeFactory::new()->count(2)
        ->createWithExistedRandomCharacteristic()
        ->withSortingOrder()
        ->create();

    foreach ($variations as $index => $variation) {
        $variationCharacteristic = VariationCharacteristic::factory()
            ->for($variation)
            ->for($characteristics[$index])
            ->create();

        $variationCharacteristic->variationAttributes()->attach(
            $attributes[$index]
        );
    }

    Livewire::test(
        CategoryFilter::class,
        ['url' => $category->slug . '/' . Str::slug($attributes[0]->name)]
    )
        ->assertSee($variations[0]->name)
        ->assertDontSee($variations[1]->name)
        ->assertDontSee($variationWithoutCategory);

    Livewire::test(
        CategoryFilter::class,
        ['url' => $category->slug . '/not_existing_attribute_slug']
    )
        ->assertSee($variations[0]->name)
        ->assertSee($variations[1]->name)
        ->assertDontSee($variationWithoutCategory);

    Livewire::test(CategoryFilter::class, [
        'url' => $category->slug . '/not_existing_attribute_slug/' . Str::slug(
            $attributes[0]->name
        ),
    ])
        ->assertSee($variations[0]->name)
        ->assertDontSee($variations[1]->name)
        ->assertDontSee($variationWithoutCategory);
});
