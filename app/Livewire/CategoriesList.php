<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoriesList extends Component
{
    public function render()
    {
        return view('livewire.categories-list', [
            'categories' => Category::all(),
        ]);
    }
}
