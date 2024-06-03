<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Variation;
use Livewire\Attributes\On;
use Livewire\Component;

class Wishlist extends Component
{
    #[On('add-wishlist')]
    public function render()
    {
        $wishlistProducts = session('wishlist', []);

        return view('livewire.pages.wishlist', [
            'variations' => Variation::find($wishlistProducts),
        ])
            ->extends('layouts.main');
    }
}
