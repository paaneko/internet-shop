<?php

namespace App\Livewire\Modal;

use App\Services\CartService;
use App\Services\CheckoutService;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    protected CartService $cartService;

    protected CheckoutService $checkoutService;

    public bool $isModalOpen = false;

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

    #[On('open-cart-modal')]
    public function openModal(): void
    {
        $this->isModalOpen = true;
    }

    public function closeModal(): void
    {
        $this->isModalOpen = false;
    }

    public function addToCart(int $variationId): void
    {
        $this->cartService->addItem($variationId);
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
