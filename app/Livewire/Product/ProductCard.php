<?php

namespace App\Livewire\Product;

use App\Models\Variation;
use App\Services\CartService;
use App\Services\CompareService;
use App\Services\WishlistService;
use Livewire\Component;

// TODO rename this class to VariationCard
class ProductCard extends Component
{
    public Variation $variation;

    protected WishlistService $wishlistService;

    protected CompareService $compareService;

    protected CartService $cartService;

    public function boot(
        WishlistService $wishlistService,
        CompareService $compareService,
        CartService $cartService,
    ): void {
        $this->wishlistService = $wishlistService;
        $this->compareService = $compareService;
        $this->cartService = $cartService;
    }

    public function addToWishlist(): void
    {
        $this->wishlistService->addItemToggle($this->variation->id);

        $this->dispatch('add-wishlist');
    }

    public function addToCompareProducts(): void
    {
        $this->compareService->addItemToggle($this->variation->id);

        $this->dispatch('add-compare-products');
    }

    public function addToCart(): void
    {
        $this->cartService->addItem($this->variation->id);
        $this->dispatch('open-cart-modal');
    }

    public function render()
    {
        return view('livewire.product.product-card', [
            'isInCompare' => $this->compareService->isItemInCompare(
                $this->variation->id
            ),
            'isInWishlist' => $this->wishlistService->isItemInWishlist(
                $this->variation->id
            ),
            'isInCart' => $this->cartService->isItemInCart(
                $this->variation->id
            ),
        ]);
    }
}
