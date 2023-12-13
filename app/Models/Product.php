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

class Product extends Model
{
    use HasFactory;

    protected $casts
        = [
            'indexation' => 'boolean',
            'status' => Status::class,
            'price' => MoneyCast::class,
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
            'price',
            'count',
            'status',
            'indexation',
        ];

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

    public function faqs(): HasMany
    {
        return $this->hasMany(ProductFaq::class);
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
}
