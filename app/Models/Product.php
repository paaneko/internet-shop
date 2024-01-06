<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\Product\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $casts
        = [
            'indexation' => 'boolean',
            'status' => Status::class,
            'price' => MoneyCast::class,
        ];

    protected $fillable
        = [
            'brand_id',
            'name',
            'slug',
            'image_url',
            'meta_tag_h1',
            'meta_tag_title',
            'meta_tag_description',
            'description',
            'product_code',
            'sku',
            'upc',
            'ean',
            'jan',
            'mpn',
            'price',
            'count',
            'status',
            'indexation',
        ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'category_product',
            'product_id',
            'category_id'
        );
    }

    public function productCharacteristics(): HasMany
    {
        return $this->hasMany(ProductCharacteristic::class);
    }

    public function groupedProductCharacteristics(): Collection
    {
        return $this->productCharacteristics()->get()->mapToGroups(
            function ($item) {
                return [
                    $item->characteristic->characteristicGroup->name => [
                        $item->characteristic->name => $item->productAttributes->pluck(
                            'name'
                        ),
                    ],
                ];
            }
        );
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(ProductFaq::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ProductComment::class);
    }

    public function recommendedInCategories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'productable');
    }

    public function recommendedInBrands(): MorphToMany
    {
        return $this->morphedByMany(Brand::class, 'productable');
    }

    public function recommendedInProducts(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'productable');
    }

    public function productRecommendations(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('main')
            ->format('webp')
            ->withResponsiveImages()
            ->nonQueued();

        $this->addMediaConversion('thumb')
            ->format('webp')
            ->width(228)
            ->height(228)
            ->nonQueued();

        $this->addMediaConversion('mini')
            ->format('webp')
            ->width(50)
            ->height(50)
            ->nonQueued();
    }
}
