<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\CategoryFilterService\PriceRangeRepositoryDto;
use App\DTOs\CategoryFilterService\PriceRangeUrlDto;
use App\DTOs\CategoryFilterService\ProductFilterDto;
use App\Models\Category;
use App\Repositories\FilteredProductsRepository;
use App\Repositories\ProductFilterPriceRangeRepository;
use App\Repositories\ProductFiltersRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\Url\Url;

class CategoryFilterService
{
    private const PAGINATION_COUNT = 8;

    private PriceRangeUrlDto|false $selectedPriceRange = false;

    private Category $category;

    private Collection $selectedFilterItems;

    public function __construct(string $uri)
    {
        /** if string is empty returns empty collection */
        $this->selectedFilterItems = $this->initFromUri($uri);
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
        /** if no price range selected it would not add a price filtering query */
        $repository = new FilteredProductsRepository(
            $this->category,
            $this->selectedPriceRange,
            self::PAGINATION_COUNT
        );

        if ($this->selectedFilterItems->isEmpty()) {
            return $repository->all();
        }

        return $repository->filter($this->selectedFilterItems);
    }

    public function getPriceRange(): PriceRangeRepositoryDto
    {
        $repository = new ProductFilterPriceRangeRepository(
            $this->category
        );

        if ($this->selectedFilterItems->isEmpty()) {
            return PriceRangeRepositoryDto::fromRepository($repository->all());
        }

        return PriceRangeRepositoryDto::fromRepository($repository->filter($this->selectedFilterItems));
    }

    public function getSelectedFilterItems()
    {
        return $this->selectedFilterItems;
    }

    private function initFromUri(string $uri): Collection
    {
        $url = Url::fromString($uri);
        $segments = collect($url->getSegments());

        /** removing the first segment that related to category slug */
        $this->category = Category::whereSlug($segments->shift())->firstOrFail();

        foreach ($segments as $key => $segment) {
            $result = preg_match('/price_(\d+)~(\d+)/', $segment, $matches);
            if ($result) {
                /** removing the price range segment because it is not part of filter items */
                $segments->forget($key);
                $this->selectedPriceRange = PriceRangeUrlDto::fromUrl(
                    $matches[1],
                    $matches[2]
                );
                break;
            }
        }

        if (is_null($url->getSegment(1))) {
            return collect();
        }

        return $segments;
    }
}
