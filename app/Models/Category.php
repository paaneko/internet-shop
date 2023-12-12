<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        ];

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

    public function faqs(): HasMany
    {
        return $this->hasMany(CategoryFaq::class);
    }
}
