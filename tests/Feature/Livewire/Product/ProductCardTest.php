<?php

use App\Livewire\Product\ProductCard;
use Database\Factories\ProductFactory;

it('changes color button after adding to wishlist', function () {
    $first_product = ProductFactory::new()->create();

    Livewire::test(ProductCard::class, [
        'product' => $first_product,
    ])
        ->call('addToWishlist')
        ->assertSee('bg-lime-500');

    Livewire::test(ProductCard::class, [
        'product' => $first_product,
    ])
        ->call('addToWishlist')
        ->assertSee('bg-gray-100');
});

it('changes color button after adding to compare-products', function () {
    $first_product = ProductFactory::new()->create();

    Livewire::test(ProductCard::class, [
        'product' => $first_product,
    ])
        ->call('addToCompareProducts')
        ->assertSee('bg-lime-500');

    Livewire::test(ProductCard::class, [
        'product' => $first_product,
    ])
        ->call('addToCompareProducts')
        ->assertSee('bg-gray-100');
});
