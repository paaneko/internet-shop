<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Variation;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.pages.home', [
            'products' => Variation::with('product.variations')
                ->take(8)
                ->get(),
        ])
            ->extends('layouts.main');
    }
}
