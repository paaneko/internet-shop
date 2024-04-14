<?php

namespace App\Livewire\Product;

use App\Models\Variation;
use App\Services\CompareService;
use App\Services\WishlistService;
use Livewire\Component;

class ProductCard extends Component
{
    public Variation $variation;

    public function addToWishlist(WishlistService $wishlistService): void
    {
        $wishlistService->addItemToggle($this->variation->id);

        $this->dispatch('add-wishlist');
    }

    public function addToCompareProducts(CompareService $compareProducts
    ): void {
        $compareProducts->addItemToggle($this->variation->id);

        $this->dispatch('add-compare-products');
    }

    public function render()
    {
        return view('livewire.product.product-card');
    }
}
