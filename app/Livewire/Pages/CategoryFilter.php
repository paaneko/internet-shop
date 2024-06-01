<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Services\CategoryFilterService;
use Livewire\Component;

class CategoryFilter extends Component
{
    protected CategoryFilterService $categoryFilterService;

    public function mount(Category $category, ?string $filterUrl = ''): void
    {
        $this->categoryFilterService = new CategoryFilterService($category, $filterUrl);
    }

    public function render()
    {
        return view('livewire.pages.category-filter', [
            'filteredProducts' => $this->categoryFilterService->getFilteredProducts(),
            'productFilter' => $this->categoryFilterService->getProductFilters(),
            'selectedFilterItems' => $this->categoryFilterService->getSelectedFilterItems(),
        ])
            ->extends('layouts.main');
    }
}
