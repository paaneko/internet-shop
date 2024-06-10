<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
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

    public function faqs(): HasMany
    {
        return $this->hasMany(CategoryFaq::class);
    }

    public function productRecommendations(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable');
    }
}
