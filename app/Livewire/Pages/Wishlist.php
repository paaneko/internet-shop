<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class Wishlist extends Component
{
    #[On('add-wishlist')]
    public function render()
    {
        $wishlistProducts = session('wishlist', []);

        return view('livewire.pages.wishlist', [
            'products' => Product::find($wishlistProducts),
        ]);
    }
}
