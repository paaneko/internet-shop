<?php

declare(strict_types=1);

use App\Livewire\Pages\Compare;
use App\Livewire\Product\ProductCard;
use Database\Factories\ProductFactory;
use Database\Factories\VariationFactory;

it('can render page', function () {
    $response = $this->get('/compare');

    $response->assertStatus(200);
});

it('can add variations', function () {
    ProductFactory::new()->create();
    $first_variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();
    $second_variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    Livewire::test(ProductCard::class, [
        'variation' => $first_variation,
    ])
        ->call('addToCompareProducts');

    Livewire::test(Compare::class)
        ->assertSee($first_variation->name)
        ->assertDontSee($second_variation->name);

    Livewire::test(ProductCard::class, [
        'variation' => $first_variation,
    ])
        ->call('addToCompareProducts');

    Livewire::test(Compare::class)
        ->assertDontSee($first_variation->name)
        ->assertDontSee($second_variation->name);
});
