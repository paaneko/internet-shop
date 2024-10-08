<?php

declare(strict_types=1);

namespace App\Livewire\Product;

use App\Models\Variation;
use App\Services\CartService;
use App\Services\CompareService;
use App\Services\WishlistService;
use Illuminate\Support\Collection;
use Livewire\Component;

class VariationActionBlock extends Component
{
    public Variation $variation;

    /** @var Collection|Variation[] */
    public Collection|array $relatedVariations;

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
    }

    public function addToCompare(): void
    {
        $this->compareService->addItemToggle($this->variation->id);
    }

    public function render()
    {
        return view('livewire.product.variation-action-block', [
            'isInWishlist' => $this->wishlistService->isItemInWishlist(
                $this->variation->id
            ),
            'isInCompare' => $this->compareService->isItemInCompare(
                $this->variation->id
            ),
            'isInCart' => $this->cartService->isItemInCart(
                $this->variation->id
            ),
        ]);
    }
}
