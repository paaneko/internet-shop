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

it(
    'can change price rendering depending if variation has old_price ≠ 0',
    function () {
        ProductFactory::new()->create();

        $variation_with_sale_price = VariationFactory::new()
            ->createWithRandomCreatedProduct()
            ->state([
                'price' => 1000,
                'old_price' => 950,
            ])
            ->create();

        Livewire::test(ProductCard::class, [
            'variation' => $variation_with_sale_price,
        ])
            ->call('addToCompareProducts')
            ->assertSee('$1000')
            ->assertSee('$950');

        $variation_without_sale_price = VariationFactory::new()
            ->createWithRandomCreatedProduct()
            ->state([
                'price' => 1000,
                'old_price' => 0,
            ])
            ->create();

        Livewire::test(ProductCard::class, [
            'variation' => $variation_without_sale_price,
        ])
            ->call('addToCompareProducts')
            ->assertSee('$1000')
            ->assertDontSee('$0');
    }
);
