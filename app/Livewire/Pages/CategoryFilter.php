<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Services\CategoryFilterService;
use Illuminate\Http\Request;
use Livewire\Component;

class CategoryFilter extends Component
{
    protected CategoryFilterService $categoryFilterService;

    public function mount(Request $request): void
    {
        $this->categoryFilterService = new CategoryFilterService(
            $request->getRequestUri()
        );
    }

    public function render()
    {
        return view('livewire.pages.category-filter', [
            'filteredProducts' => $this->categoryFilterService->getFilteredProducts(),
            'productFilter' => $this->categoryFilterService->getProductFilters(),
            'selectedFilterItems' => $this->categoryFilterService->getSelectedFilterItems(),
            'priceRange' => $this->categoryFilterService->getPriceRange(),
            'url' => url()->current(),
        ])
            ->extends('layouts.main');
    }
}
