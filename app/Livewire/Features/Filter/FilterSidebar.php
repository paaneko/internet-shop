<?php

declare(strict_types=1);

namespace App\Livewire\Features\Filter;

use App\DTOs\CategoryFilterService\ProductFilterDto;
use Illuminate\Support\Collection;
use Livewire\Component;

class FilterSidebar extends Component
{
    protected ProductFilterDto $productFilter;

    protected Collection $selectedFilterItems;

    public string $url;

    public function mount($productFilter, $selectedFilterItems): void
    {
        $this->productFilter = $productFilter;
        $this->selectedFilterItems = $selectedFilterItems;
    }

    public function click(): void
    {
        $this->dispatch('update-url', 'Hello world');
    }

    public function changeUrl(string $url): void
    {
        $this->url = $url;
    }

    public function render()
    {
        return view('livewire.features.filter.filter-sidebar', [
            'productFilter' => $this->productFilter,
            'selectedFilterItems' => $this->selectedFilterItems,
        ]);
    }
}
