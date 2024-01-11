<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class CompareProducts extends Component
{
    #[On('add-compare-products')]
    public function render()
    {
        $compareProducts = session('compare-products', []);

        return view('livewire.pages.compare-products', [
            'products' => Product::find($compareProducts),
        ]);
    }
}
