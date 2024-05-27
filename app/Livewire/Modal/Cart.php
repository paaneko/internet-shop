<?php

declare(strict_types=1);

namespace App\Livewire\Modal;

use App\Services\CartService;
use App\Services\CheckoutService;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    protected CartService $cartService;

    protected CheckoutService $checkoutService;

    public function boot(
        CartService $cartService,
        CheckoutService $checkoutService
    ): void {
        $this->cartService = $cartService;
        $this->checkoutService = $checkoutService;
    }

    public function checkout()
    {
        return $this->checkoutService->proceedCheckout(
            $this->cartService->getItems()
        );
    }

    #[On('add-item-to-cart')]
    public function addToCart(int $id): void
    {
        $this->cartService->addItem($id);
    }

    public function removeFromCart(int $variationId): void
    {
        $this->cartService->removeItem($variationId);
    }

    public function deleteItem(int $variationId): void
    {
        $this->cartService->removeItemEntirely($variationId);
    }

    public function removeAll(): void
    {
        $this->cartService->removeCartEntirely();

        $this->dispatch('refresh-category-list');
    }

    public function render()
    {
        return view('livewire.modal.cart', [
            'cartItems' => collect($this->cartService->getItems()),
        ]);
    }
}
