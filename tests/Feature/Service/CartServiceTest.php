<?php

use App\Services\CartService;
use Database\Factories\ProductFactory;
use Database\Factories\VariationFactory;

beforeEach(function () {
    ProductFactory::new()
        ->create();

    $this->cartService = app(CartService::class);
});

it('can add variation to cart', function () {
    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $this->cartService->addItem($variation->id);

    $cartItems = $this->cartService->getItems();

    expect(isset($cartItems[$variation->id]))->toBeTrue();
});

it('can increment variation in cart', function () {
    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $this->cartService->addItem($variation->id);
    $this->cartService->addItem($variation->id);

    $cartItems = $this->cartService->getItems();

    expect($cartItems[$variation->id]['quantity'])->toBe(2);
});

it('can decrement variation in cart', function () {
    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $this->cartService->addItem($variation->id);
    $this->cartService->addItem($variation->id);

    $this->cartService->removeItem($variation->id);

    $cartItems = $this->cartService->getItems();

    expect($cartItems[$variation->id]['quantity'])->toBe(1);
});

it('can remove variation when only one item in cart', function () {
    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $this->cartService->addItem($variation->id);
    $this->cartService->removeItem($variation->id);

    $cartItems = $this->cartService->getItems();

    expect(isset($cartItems[$variation->id]))->toBeFalse();
});

it(
    'throws exception when trying to remove variation that do not exists in cart',
    function () {
        $variation = VariationFactory::new()
            ->createWithRandomCreatedProduct()
            ->create();

        $this->cartService->addItem($variation->id);
        $this->cartService->addItem($variation->id);
        $this->cartService->removeItem($variation->id);

        $cartItems = $this->cartService->getItems();

        expect($cartItems[$variation->id]['quantity'])->toBe(1);

        $not_in_cart_variation = VariationFactory::new()
            ->createWithRandomCreatedProduct()
            ->create();

        $this->cartService->removeItem($not_in_cart_variation->id);
        /** Expecting Exception */
    }
)->throws(
    RuntimeException::class,
    'This variation not found in cart'
);

it('can remove entirely variation from cart', function () {
    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create();

    $this->cartService->addItem($variation->id);
    $this->cartService->addItem($variation->id);
    $this->cartService->addItem($variation->id);

    $this->cartService->removeItemEntirely($variation->id);

    $cartItems = $this->cartService->getItems();

    expect(isset($cartItems[$variation->id]))->toBeFalse();
});

it(
    'throws exception when trying to remove entirely variation that do not exists in cart',
    function () {
        $variation = VariationFactory::new()
            ->createWithRandomCreatedProduct()
            ->create();

        $this->cartService->addItem($variation->id);
        $this->cartService->addItem($variation->id);
        $this->cartService->removeItem($variation->id);

        $cartItems = $this->cartService->getItems();

        expect($cartItems[$variation->id]['quantity'])->toBe(1);

        $not_in_cart_variation = VariationFactory::new()
            ->createWithRandomCreatedProduct()
            ->create();

        $this->cartService->removeItemEntirely($not_in_cart_variation->id);
        /** Expecting Exception */
    }
)->throws(
    RuntimeException::class,
    'This variation not found in cart'
);
