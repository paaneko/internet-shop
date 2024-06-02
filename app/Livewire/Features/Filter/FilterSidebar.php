<?php

declare(strict_types=1);

namespace App\Livewire\Features\Filter;

use App\DTOs\CategoryFilterService\PriceRangeRepositoryDto;
use App\DTOs\CategoryFilterService\ProductFilterDto;
use Illuminate\Support\Collection;
use Livewire\Component;
use Spatie\Url\Url;

class FilterSidebar extends Component
{
    protected ProductFilterDto $productFilter;

    protected PriceRangeRepositoryDto $priceRange;

    protected Collection $selectedFilterItems;

    public string $url;

    public function mount($productFilter, $selectedFilterItems, $priceRange): void
    {
        $this->productFilter = $productFilter;
        $this->selectedFilterItems = $selectedFilterItems;
        $this->priceRange = $priceRange;
    }

    public function setPriceRange($min, $max): void
    {
        $isPriceRangeExist = false;
        $segments = Url::fromString($this->url)->getSegments();

        $result = array_map(function ($segment) use ($min, $max, &$isPriceRangeExist) {
            if (str_contains($segment, 'price_')) {
                $isPriceRangeExist = true;

                return "price_{$min}~{$max}";
            }

            return $segment;
        }, $segments);

        if (! $isPriceRangeExist) {
            $result[] = "price_{$min}~{$max}";
        }

        $this->redirect(asset(implode('/', $result)), true);
    }

    // TODO you can refactor this better
    private function getSelectedPriceRange(): array
    {
        $segments = Url::fromString($this->url)->getSegments();

        foreach ($segments as $segment) {
            $result = preg_match('/price_(\d+)~(\d+)/', $segment, $matches);
            if ($result) {
                return [
                    'min' => $matches[1],
                    'max' => $matches[2],
                ];
            }
        }

        return [
            'min' => $this->priceRange->min_price,
            'max' => $this->priceRange->max_price,
        ];
    }

    public function render()
    {
        return view('livewire.features.filter.filter-sidebar', [
            'productFilter' => $this->productFilter,
            'selectedFilterItems' => $this->selectedFilterItems,
            'priceRange' => $this->priceRange,
            'selectedPriceRange' => $this->getSelectedPriceRange(),
        ]);
    }
}
