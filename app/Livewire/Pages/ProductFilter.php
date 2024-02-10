<?php

namespace App\Livewire\Pages;

use App\Services\ProductFilterService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ProductFilter extends Component
{
    protected LengthAwarePaginator $products;

    public Collection $categoryFilters;

    public function mount(string $url): void
    {
        $productFilterService = new ProductFilterService($url);

        $this->products = $productFilterService->getProducts();

        $this->categoryFilters = $productFilterService->getCategoryFilters();
    }

    #[Layout('layouts.product-filter-layout')]
    public function render()
    {
        return view('livewire.pages.product-filter', [
            'categoryProducts' => $this->products,
        ]);
    }
}
