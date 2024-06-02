<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\FilteredProductsInterface;
use App\Models\Category;
use App\Models\Variation;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

readonly class FilteredProductsRepository implements FilteredProductsInterface
{
    public function __construct(
        private Category $category,
        private int $minPrice,
        private int $maxPrice,
        private int $pagination
    ) {
    }

    public function all(): LengthAwarePaginator
    {
        return Variation::select('variations.*')
            ->with('product.variations')
            ->join('products', 'variations.product_id', '=', 'products.id')
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->whereRaw('COALESCE(NULLIF(price, 0), NULLIF(old_price, 0)) BETWEEN ? AND ?', [$this->minPrice, $this->maxPrice])
            ->where('categories.id', '=', $this->category->id)
            ->groupBy('variations.id')
            ->paginate($this->pagination);
    }

    public function filter(Collection $attributes): LengthAwarePaginator
    {
        return Variation::select(['variations.*', DB::raw('COUNT(vca.characteristic_attribute_slug) as attribute_count')])
            ->with(['product.variations', 'variationCharacteristics.variationAttributes'])
            ->join('variation_characteristics as vc', 'variations.id', '=', 'vc.variation_id')
            ->join('variation_characteristic_attributes as vca', 'vc.id', '=', 'vca.variation_characteristic_id')
            ->join('products', 'variations.product_id', '=', 'products.id')
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->whereRaw('COALESCE(NULLIF(price, 0), NULLIF(old_price, 0)) BETWEEN ? AND ?', [$this->minPrice, $this->maxPrice])
            ->where('categories.id', '=', $this->category->id)
            ->whereIn('vca.characteristic_attribute_slug', $attributes)
            ->groupBy('variations.id')
            ->havingRaw('COUNT(vca.characteristic_attribute_slug) = ?', [$attributes->count()])
            ->paginate($this->pagination);
    }
}
