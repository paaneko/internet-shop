<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Category;
use DB;
use Illuminate\Support\Collection;

readonly class ProductFilterPriceRangeRepository
{
    public function __construct(
        private Category $category,
    ) {
    }

    public function all()
    {
        return DB::table('variations')
            ->join('products', 'variations.product_id', '=', 'products.id')
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where('categories.id', '=', 1)
            ->selectRaw('MIN(COALESCE(NULLIF(price, 0), NULLIF(old_price, 0))) as min_price')
            ->selectRaw('MAX(COALESCE(NULLIF(price, 0), NULLIF(old_price, 0))) as max_price')
            ->first();
    }

    public function filter(Collection $attributes)
    {
        $subquery = DB::table('variations')
            ->select(['variations.id', DB::raw('COUNT(vca.characteristic_attribute_slug) as attribute_count')])
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
            ->selectRaw('MIN(COALESCE(NULLIF(price, 0), NULLIF(old_price, 0))) as min_price')
            ->selectRaw('MAX(COALESCE(NULLIF(price, 0), NULLIF(old_price, 0))) as max_price')
            ->first();
    }
}
