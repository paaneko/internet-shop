<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\Product\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Variation extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $casts
        = [
            'indexation' => 'boolean',
            'status' => Status::class,
            'price' => MoneyCast::class,
            'old_price' => MoneyCast::class,
        ];

    protected $fillable
        = [
            'product_id',
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
            'old_price',
            'count',
            'color',
            'indexation',
        ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variationCharacteristics(): HasMany
    {
        return $this->hasMany(VariationCharacteristic::class);
    }

    public function orderItems(): MorphMany
    {
        return $this->morphMany(OrderItem::class, 'item');
    }

    public function groupedVariationCharacteristics(): Collection
    {
        return $this->variationCharacteristics()->get()->mapToGroups(
            function ($item) {
                return [
                    $item->characteristic->characteristicGroup->name => [
                        $item->characteristic->name => $item->variationAttributes->pluck(
                            'name'
                        ),
                    ],
                ];
            }
        );
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('main')
            ->format('webp')
            ->width(600)
            ->height(600)
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
