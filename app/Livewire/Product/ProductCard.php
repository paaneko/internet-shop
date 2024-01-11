<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Services\CompareProducts;
use App\Services\WishlistService;
use Livewire\Component;

class ProductCard extends Component
{
    public Product $product;

    public function addToWishlist(WishlistService $wishlistService): void
    {
        $wishlistService->addItemToggle($this->product->id);

        $this->dispatch('add-wishlist');
    }

    public function addToCompareProducts(CompareProducts $compareProducts): void
    {
        $compareProducts->addItemToggle($this->product->id);

        $this->dispatch('add-compare-products');
    }

    public function render()
    {
        return view('livewire.product.product-card');
    }
}
