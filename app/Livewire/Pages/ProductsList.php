<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.pages.products-list', [
            'products' => Product::paginate(10),
        ]);
    }
}
