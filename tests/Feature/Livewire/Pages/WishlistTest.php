<?php

use App\Livewire\Pages\Wishlist;
use App\Livewire\Product\ProductCard;
use Database\Factories\ProductFactory;

it('can render page', function () {
    $response = $this->get('/wishlist');

    $response->assertStatus(200);
});

it('can add products', function () {
    $first_product = ProductFactory::new()->create();
    $second_product = ProductFactory::new()->create();

    Livewire::test(ProductCard::class, [
        'product' => $first_product,
    ])
        ->call('addToWishlist');

    Livewire::test(Wishlist::class)
        ->assertSee($first_product->name)
        ->assertDontSee($second_product->name);

    Livewire::test(ProductCard::class, [
        'product' => $first_product,
    ])
        ->call('addToWishlist');

    Livewire::test(Wishlist::class)
        ->assertDontSee($first_product->name)
        ->assertDontSee($second_product->name);
});
