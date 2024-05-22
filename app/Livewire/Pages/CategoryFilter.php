<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Services\CategoryFilterService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CategoryFilter extends Component
{
    protected LengthAwarePaginator $products;

    public Collection $categoryFilters;

    public function mount(string $url): void
    {
        $productFilterService = new CategoryFilterService($url);

        $this->products = $productFilterService->getVariations();

        $this->categoryFilters = $productFilterService->getCategoryFilters();
    }

    #[Layout('layouts.product-filter-layout')]
    public function render()
    {
        return view('livewire.pages.category-filter', [
            'categoryProducts' => $this->products,
        ]);
    }
}
