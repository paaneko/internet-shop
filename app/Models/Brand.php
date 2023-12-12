<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    public $timestamps = true;

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

    public function faqs(): HasMany
    {
        return $this->hasMany(BrandFaq::class);
    }
}
