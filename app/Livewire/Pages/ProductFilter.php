<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\CharacteristicAttribute;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Url\Url;

class ProductFilter extends Component
{
    protected const PAGINATION_COUNT = 8;

    protected LengthAwarePaginator $products;

    public string $categorySlug;

    public Collection $urlAttributes;

    public Category $category;

    public Collection $categoryFilters;

    public Collection $selectedFilters;

    public Collection $testFilters;

    public function mount()
    {
        $this->selectedFilters = collect();

        $this->categorySlug = Url::fromString(url()->current())->getSegment(1);

        $this->urlAttributes = collect(
            Url::fromString(url()->current())->getSegments()
        )->except(0);

        $this->category = Category::where('slug', $this->categorySlug)
            ->firstOrFail();

        $this->getSelectedFilters();

        $this->products = ($this->urlAttributes->isEmpty())
            ? $this->category->products()->paginate(self::PAGINATION_COUNT)
            : $this->category->products()->whereHas(
                'productCharacteristics.productAttributes',
                function ($query) {
                    $query->whereIn(
                        'characteristic_attributes.id',
                        $this->selectedFilters
                    );
                }
            )->paginate(self::PAGINATION_COUNT);

        $this->attachUrlsToCategoryFilters(
            $this->category->productAttributes($this->selectFilterProductIds())
        );
    }

    protected function getSelectedFilters(): void
    {
        /** ⚠️unnecessary database query⚠️
         *
         *  Think about adding slug column to products attributes
         *  This allows passing selected attributes slugs directly to query
         *  instead of id's
         */
        CharacteristicAttribute::whereHas(
            'productCharacteristics.product.categories',
            function ($query) {
                $query->whereIn('categories.id', [1]);
            }
        )->get()->map(function ($attribute) {
            if ($this->urlAttributes->search(Str::slug($attribute['name']))) {
                $this->selectedFilters->push($attribute['id']);
            }
        });
    }

    protected function attachUrlsToCategoryFilters(Collection $data): void
    {
        $this->categoryFilters = $data->transform(function (Collection $item) {
            $item->transform(function ($attribute) {
                /** Does Attribute Exist In Url contain bool|int */
                $isAttributeExist = $this->urlAttributes->search(
                    $attribute['slug']
                );

                $urlAttributesCopy = $this->urlAttributes->collect();

                if ($isAttributeExist) {
                    $urlAttributesCopy->forget(
                        $isAttributeExist
                    );
                    $attribute['is_selected'] = true;
                } else {
                    $urlAttributesCopy->push(
                        $attribute['slug']
                    );
                    $attribute['is_selected'] = false;
                }

                $attribute['url'] = self::buildUrl($urlAttributesCopy);

                return $attribute;
            });

            return $item;
        });
    }

    protected function buildUrl(Collection $urlCollection): string
    {
        return '/'.$this->categorySlug.'/'.$urlCollection->implode('/');
    }

    protected function selectFilterProductIds(): Collection
    {
        /** TODO optimize by selecting only ids from query without mapping afterwards */
        $result = ($this->urlAttributes->isEmpty())
            ? $this->category->products()->get()
            : $this->category->products()->whereHas(
                'productCharacteristics.productAttributes',
                function ($query) {
                    $query->whereIn(
                        'characteristic_attributes.id',
                        $this->selectedFilters
                    );
                }
            )->get();

        return $result->map(function ($product) {
            return $product->id;
        });
    }

    #[Layout('layouts.product-filter-layout')]
    public function render()
    {
        return view('livewire.pages.product-filter', [
            'categoryProducts' => $this->products,
        ]);
    }
}
