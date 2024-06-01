<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\CategoryFilterService\ProductFilterDto;
use App\Models\Category;
use App\Repositories\FilteredProductsRepository;
use App\Repositories\ProductFiltersRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\Url\Url;

class CategoryFilterService
{
    private const PAGINATION_COUNT = 8;

    private const MIN_PRICE = 0;

    private const MAX_PRICE = 10000000;

    private Category $category;

    private Collection $selectedFilterItems;

    public function __construct(Category $category, string $filterUrl)
    {
        $this->category = $category;

        /** if string is empty returns empty collection */
        $this->selectedFilterItems = $this->extractUrlSegments($filterUrl);
    }

    public function getProductFilters(): ProductFilterDto
    {
        $repository = new ProductFiltersRepository($this->category);

        if ($this->selectedFilterItems->isEmpty()) {
            return ProductFilterDto::fromCollection($repository->all());
        }

        return ProductFilterDto::fromCollection($repository->filter($this->selectedFilterItems));
    }

    public function getFilteredProducts(): LengthAwarePaginator
    {
        $repository = new FilteredProductsRepository(
            $this->category,
            self::MIN_PRICE,
            self::MAX_PRICE,
            self::PAGINATION_COUNT
        );

        if ($this->selectedFilterItems->isEmpty()) {
            return $repository->all();
        }

        return $repository->filter($this->selectedFilterItems);
    }

    public function getSelectedFilterItems()
    {
        return $this->selectedFilterItems;
    }

    private function extractUrlSegments(string $url): Collection
    {
        if ($url == '') {
            return collect();
        }

        return collect(Url::fromString($url)->getSegments());
    }
}
