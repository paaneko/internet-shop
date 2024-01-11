<?php

namespace App\Livewire\Product;

use Illuminate\Support\Collection;
use Livewire\Component;

class AnaloguesList extends Component
{
    public Collection $products;

    public function render()
    {
        return view('livewire.product.analogues-list');
    }
}
