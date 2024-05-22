<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Variation;
use Livewire\Attributes\On;
use Livewire\Component;

class Compare extends Component
{
    #[On('add-compare-products')]
    public function render()
    {
        $compareVariation = session('compare', []);

        return view('livewire.pages.compare', [
            'variations' => Variation::find($compareVariation),
        ]);
    }
}
