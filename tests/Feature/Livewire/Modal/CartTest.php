<?php

use App\Livewire\Modal\Cart;
use App\Services\CartService;
use Database\Factories\ProductFactory;
use Database\Factories\VariationFactory;

beforeEach(function () {
    ProductFactory::new()
        ->create();

    $this->cartService = app(CartService::class);
});

it('can render cart modal', function () {
    Livewire::test(Cart::class)
        ->assertSeeLivewire(Cart::class);
});

it('can open cart modal', function () {
    Livewire::test(Cart::class)
        ->call('openModal')
        ->assertSee('SHOPPING CART');
});

it('can close cart modal', function () {
    Livewire::test(Cart::class)
        ->call('openModal')
        ->call('closeModal')
        ->assertDontSee('SHOPPING CART');
});

it('displays message when cart empty', function () {
    Livewire::test(Cart::class)
        ->call('openModal')
        ->assertSee('Your cart is empty');
});

it('can display one or more items in cart', function () {
    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $variation_2 = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $this->cartService->addItem($variation->id);

    Livewire::test(Cart::class)
        ->call('openModal')
        ->assertSee($variation->name);

    $this->cartService->addItem($variation_2->id);

    Livewire::test(Cart::class)
        ->call('openModal')
        ->assertSee($variation->name)
        ->assertSee($variation_2->name);

    $this->cartService->removeCartEntirely();

    Livewire::test(Cart::class)
        ->call('openModal')
        ->assertDontSee($variation->name)
        ->assertDontSee($variation_2->name);
});

it('can increment item', function () {
    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $this->cartService->addItem($variation->id);

    Livewire::test(Cart::class)
        ->call('openModal')
        ->assertSee($variation->name)
        ->assertSeeHtml('<span class="text-lg">1</span>')
        ->call('addToCart', $variation->id)
        ->assertSeeHtml('<span class="text-lg">2</span>');
});

it('can decrement item', function () {
    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $this->cartService->addItem($variation->id);

    Livewire::test(Cart::class)
        ->call('openModal')
        ->assertSee($variation->name)
        ->assertSeeHtml('<span class="text-lg">1</span>')
        ->call('addToCart', $variation->id)
        ->assertSeeHtml('<span class="text-lg">2</span>')
        ->call('removeFromCart', $variation->id)
        ->assertSeeHtml('<span class="text-lg">1</span>');
});

it('can remove item from cart after decrement if quantity is one', function () {
    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $this->cartService->addItem($variation->id);

    Livewire::test(Cart::class)
        ->call('openModal')
        ->assertSee($variation->name)
        ->assertSeeHtml('<span class="text-lg">1</span>')
        ->call('removeFromCart', $variation->id)
        ->assertDontSee($variation->name);
});

it('can entirely remove item from cart if quantity more than one', function () {
    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $this->cartService->addItem($variation->id);
    $this->cartService->addItem($variation->id);
    $this->cartService->addItem($variation->id);
    Livewire::test(Cart::class)
        ->call('openModal')
        ->assertSee($variation->name)
        ->assertSeeHtml('<span class="text-lg">3</span>')
        ->call('deleteItem', $variation->id)
        ->assertDontSee($variation->name);
});

it('can remove all item from cart by one button', function () {
    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $variation_2 = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $this->cartService->addItem($variation->id);
    $this->cartService->addItem($variation_2->id);

    Livewire::test(Cart::class)
        ->call('openModal')
        ->assertSee($variation->name)
        ->assertSee($variation_2->name);

    Livewire::test(Cart::class)
        ->call('openModal')
        ->call('removeAll')
        ->assertDontSee($variation->name)
        ->assertDontSee($variation_2->name)
        ->assertSee('Your cart is empty');
});

it('can change price equals quantity', function () {
    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create([
            'price' => 12000000,
            'old_price' => 1000000,
        ]);

    $this->cartService->addItem($variation->id);

    Livewire::test(Cart::class)
        ->call('openModal')
        ->assertSee($variation->name)
        ->assertSeeHtml('<span class="text-lg">1</span>')
        ->assertSee('$12000000')
        ->assertSee('$1000000')
        ->call('addToCart', $variation->id)
        ->assertSeeHtml('<span class="text-lg">2</span>')
        ->assertSee('$24000000')
        ->assertSee('$2000000');
});
