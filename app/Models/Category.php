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
use Illuminate\Support\Str;

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

    public function productAttributes(Collection $productIds): Collection
    {
        return
            DB::table('characteristic_attributes')
                ->where('categories.slug', $this->slug)
                ->whereIn('products.id', $productIds)
                ->join(
                    'product_characteristic_attributes',
                    'characteristic_attributes.id',
                    '=',
                    'product_characteristic_attributes.characteristic_attribute_id'
                )
                ->join(
                    'product_characteristics',
                    'product_characteristic_attributes.product_characteristic_id',
                    '=',
                    'product_characteristics.id'
                )
                ->join(
                    'products',
                    'product_characteristics.product_id',
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
                    'product_characteristics.characteristic_id',
                    '=',
                    'characteristics.id'
                )
                ->select(
                    'characteristic_attributes.id',
                    'characteristic_attributes.name as attribute_name',
                    'characteristics.name as characteristic_name',
                    DB::raw('COUNT(*) as attribute_count')
                )
                ->groupBy('characteristic_attributes.id', 'characteristic_name')
                ->get()
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

    public function faqs(): HasMany
    {
        return $this->hasMany(CategoryFaq::class);
    }

    public function productRecommendations(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable');
    }
}
