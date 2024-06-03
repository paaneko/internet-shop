<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\ProductFiltersInterface;
use App\Models\Category;
use App\Models\Variation;
use DB;
use Illuminate\Support\Collection;

readonly class ProductFiltersRepository implements ProductFiltersInterface
{
    public function __construct(
        private Category $category,
    ) {
    }

    public function all(): Collection
    {
        return DB::table('characteristic_attributes')
            ->join('variation_characteristic_attributes', 'characteristic_attributes.slug', '=', 'variation_characteristic_attributes.characteristic_attribute_slug')
            ->join('variation_characteristics', 'variation_characteristic_attributes.variation_characteristic_id', '=', 'variation_characteristics.id')
            ->join('variations', 'variation_characteristics.variation_id', '=', 'variations.id')
            ->join('products', 'variations.product_id', '=', 'products.id')
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->join('characteristics', 'variation_characteristics.characteristic_id', '=', 'characteristics.id')
            ->where('categories.id', $this->category->id)
            ->select(
                'characteristics.id',
                'characteristics.name as characteristic_name',
                'characteristics.hint_text as characteristic_hint_text',
                'characteristics.is_collapsed as characteristic_is_collapsed',
                'characteristic_attributes.id as attribute_id',
                'characteristic_attributes.name as attribute_name',
                'characteristic_attributes.slug as attribute_slug',
                DB::raw('COUNT(*) as attribute_count')
            )
            ->groupBy('characteristics.id', 'attribute_id')
            ->get();
    }

    public function filter(Collection $attributes): Collection
    {
        $subquery = Variation::select(['variations.id', DB::raw('COUNT(vca.characteristic_attribute_slug) as attribute_count')])
            ->join('variation_characteristics as vc', 'variations.id', '=', 'vc.variation_id')
            ->join('variation_characteristic_attributes as vca', 'vc.id', '=', 'vca.variation_characteristic_id')
            ->join('products', 'variations.product_id', '=', 'products.id')
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where('categories.id', $this->category->id)
            ->whereIn('vca.characteristic_attribute_slug', $attributes)
            ->groupBy('variations.id')
            ->havingRaw('COUNT(vca.characteristic_attribute_slug) = ?', [$attributes->count()])
            ->pluck('id');

        return DB::table('characteristic_attributes')
            ->join('variation_characteristic_attributes', 'characteristic_attributes.slug', '=', 'variation_characteristic_attributes.characteristic_attribute_slug')
            ->join('variation_characteristics', 'variation_characteristic_attributes.variation_characteristic_id', '=', 'variation_characteristics.id')
            ->join('variations', 'variation_characteristics.variation_id', '=', 'variations.id')
            ->join('products', 'variations.product_id', '=', 'products.id')
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->join('characteristics', 'variation_characteristics.characteristic_id', '=', 'characteristics.id')
            ->whereIn('variations.id', $subquery)
            ->where('categories.id', $this->category->id)
            ->select(
                'characteristics.id',
                'characteristics.name as characteristic_name',
                'characteristics.hint_text as characteristic_hint_text',
                'characteristics.is_collapsed as characteristic_is_collapsed',
                'characteristic_attributes.id as attribute_id',
                'characteristic_attributes.name as attribute_name',
                'characteristic_attributes.slug as attribute_slug',
                DB::raw('COUNT(characteristic_attributes.id) as attribute_count')
            )
            ->groupBy('characteristics.id', 'attribute_id')
            ->get();
    }
}
