<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $casts
        = [
            'indexation' => 'boolean',
        ];

    protected $fillable
        = [
            'name',
            'slug',
            'image_url',
            'meta_tag_h1',
            'meta_tag_title',
            'meta_tag_description',
            'description',
            'indexation',
            'sorting_order',
        ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the formatted category name, considering parent-child relationship.
     *
     * This method returns a formatted category name that includes the parent
     * category's name followed by ' > ' if the category has a parent.
     * If theere is no parent, it returns the catgory's name alone.
     *
     * Can be used in resource and used via `->name_with_parent`
     */
    protected function nameWithParent(): Attribute
    {
        return Attribute::get(
            fn (): string => $this->parent && $this->parent->name
                ? $this->parent->name.' > '.$this->name
                : $this->name

        );
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'category_product',
            'category_id',
            'product_id'
        );
    }

    public function variations()
    {
        $categoryProductsIds = $this->products()->pluck('id');

        return Variation::whereIn('product_id', $categoryProductsIds);
    }

    public function variationsByAttributes(Collection $variationAttributesIds
    ) {
        return
            Variation::select('variations.*')
                ->whereIn(
                    'variation_characteristic_attributes.characteristic_attribute_id',
                    $variationAttributesIds
                )
                ->join(
                    'variation_characteristics',
                    'variations.id',
                    '=',
                    'variation_characteristics.variation_id'
                )
                ->join(
                    'variation_characteristic_attributes',
                    'variation_characteristics.id',
                    '=',
                    'variation_characteristic_attributes.variation_characteristic_id'
                )
                ->join(
                    'category_product',
                    // Assuming 'category_product' is the pivot table between 'categories' and 'products'
                    'variations.product_id',
                    // Assuming 'product_id' is the foreign key in 'variations' table
                    '=',
                    'category_product.product_id'
                )
                ->join(
                    'categories',
                    'category_product.category_id',
                    // Assuming 'category_id' is the foreign key in 'category_product' table
                    '=',
                    'categories.id'
                )
                ->where('categories.slug', $this->slug);
    }

    public function variationAttributes(Collection $variationsIds): Collection
    {
        return DB::table('characteristic_attributes')
            ->join(
                'variation_characteristic_attributes',
                'characteristic_attributes.id',
                '=',
                'variation_characteristic_attributes.characteristic_attribute_id'
            )
            ->join(
                'variation_characteristics',
                'variation_characteristic_attributes.variation_characteristic_id',
                '=',
                'variation_characteristics.id'
            )
            ->join(
                'variations',
                'variation_characteristics.variation_id',
                '=',
                'variations.id'
            )
            ->join(
                'products',
                'variations.product_id',
                '=',
                'products.id'
            )
            ->join(
                'category_product',
                'products.id',
                '=',
                'category_product.product_id'
            )
            ->join(
                'categories',
                'category_product.category_id',
                '=',
                'categories.id'
            )
            ->join(
                'characteristics',
                'variation_characteristics.characteristic_id',
                '=',
                'characteristics.id'
            )
            ->whereIn('variations.id', $variationsIds)
            ->where('categories.slug', $this->slug)
            ->select(
                'characteristic_attributes.id',
                'characteristic_attributes.name as attribute_name',
                'characteristics.name as characteristic_name',
                DB::raw('COUNT(*) as attribute_count')
            )
            ->groupBy(
                'characteristic_attributes.id',
                'attribute_name',
                'characteristic_name'
            )
            ->get();
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(CategoryFaq::class);
    }

    public function productRecommendations(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable');
    }
}
