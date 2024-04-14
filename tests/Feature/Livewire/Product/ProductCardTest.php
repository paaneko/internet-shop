<?php

use App\Livewire\Product\ProductCard;
use Database\Factories\ProductFactory;
use Database\Factories\VariationFactory;

it('changes color button after adding to wishlist', function () {
    ProductFactory::new()->create();

    $first_variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    Livewire::test(ProductCard::class, [
        'variation' => $first_variation,
    ])
        ->call('addToWishlist')
        ->assertSee('bg-lime-500');

    Livewire::test(ProductCard::class, [
        'variation' => $first_variation,
    ])
        ->call('addToWishlist')
        ->assertSee('bg-gray-100');
});

it('changes color button after adding to compare', function () {
    ProductFactory::new()->create();

    $first_variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    Livewire::test(ProductCard::class, [
        'variation' => $first_variation,
    ])
        ->call('addToCompareProducts')
        ->assertSee('bg-lime-500');

    Livewire::test(ProductCard::class, [
        'variation' => $first_variation,
    ])
        ->call('addToCompareProducts')
        ->assertSee('bg-gray-100');
});
