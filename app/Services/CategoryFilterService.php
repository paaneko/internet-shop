<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Category;
use App\Models\CharacteristicAttribute;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\Url\Url;

class CategoryFilterService
{
    private const PAGINATION_COUNT = 8;

    private Url $url;

    private Category $category;

    private Collection $urlAttributes;

    private Collection $selectedFilters;

    public function __construct(string $url)
    {
        $this->selectedFilters = collect();

        $this->url = Url::fromString($url);

        $this->category = Category::where('slug', $this->url->getSegment(1))
            ->firstOrFail();

        /** Getting current attributes slugs from url except category slug  */
        $this->urlAttributes = collect($this->url->getSegments())
            ->except(0);

        $this->getSelectedFilters();
    }

    public function getVariations(): LengthAwarePaginator
    {
        return ($this->selectedFilters->isEmpty())
            ? $this->category->variations()->paginate(
                self::PAGINATION_COUNT
            )
            : $this->category->variationsByAttributes($this->selectedFilters)
                ->paginate(self::PAGINATION_COUNT);
    }

    public function getCategoryFilters(): Collection
    {
        return $this->attachUrlsToCategoryFilters(
            $this->getVariationAttributes()
        );
    }

    public function isUrlAttributesEmpty(): bool
    {
        return $this->urlAttributes->isEmpty();
    }

    public function getVariationAttributes(): Collection
    {
        /**
         *  Transform raw data from db and group each attribute
         *  by their characteristic into groups
         *
         *  Also adding slug based on name so in future I can lock attributes
         *  slugs in ulr and after parse them from url.
         */

        return $this->category->variationAttributes(
            $this->selectFilterVariationIds()
        )
            ->mapToGroups(function ($item) {
                $item = (array) $item;

                return [
                    $item['characteristic_name'] => [
                        'id' => $item['id'],
                        'slug' => Str::slug($item['attribute_name']),
                        'name' => $item['attribute_name'],
                        'count' => $item['attribute_count'],
                    ],
                ];
            });
    }

    public function getSelectedFilters(): void
    {
        /** ⚠️unnecessary database query⚠️
         *
         *  Think about adding slug column to products attributes
         *  This allows passing selected attributes slugs directly to query
         *  instead of id's
         */
        CharacteristicAttribute::whereHas(
            'variationCharacteristics.variation.product.categories',
            function ($query) {
                $query->where('categories.slug', $this->category->slug);
            }
        )->get()->map(function ($attribute) {
            if ($this->urlAttributes->search(Str::slug($attribute['name']))) {
                $this->selectedFilters->push($attribute['id']);
            }
        });
    }

    public function selectFilterVariationIds(): Collection
    {
        /** TODO optimize by selecting only ids from query without mapping afterwards */
        $result = ($this->selectedFilters->isEmpty())
            ? $this->category->variations()->get()
            : $this->category->variationsByAttributes($this->selectedFilters)
                ->get();

        return $result->map(function ($product) {
            return $product->id;
        });
    }

    public function attachUrlsToCategoryFilters(Collection $data): Collection
    {
        return $data->transform(function (Collection $item) {
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
        return '/' . $this->category->slug . '/' . $urlCollection->implode('/');
    }
}
