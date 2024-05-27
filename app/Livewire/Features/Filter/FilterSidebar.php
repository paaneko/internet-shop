<?php

declare(strict_types=1);

namespace App\Livewire\Features\Filter;

use Illuminate\Support\Collection;
use Livewire\Component;

class FilterSidebar extends Component
{
    public Collection $categoryFilters;

    public function mount($categoryFilters): void
    {
        $this->categoryFilters = $categoryFilters;
    }

    public function render()
    {
        return view('livewire.features.filter.filter-sidebar');
    }
}
