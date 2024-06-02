<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VariationCharacteristic extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'characteristic_id',
            'sorting_order',
        ];

    public function variation(): BelongsTo
    {
        return $this->belongsTo(Variation::class);
    }

    public function characteristic(): BelongsTo
    {
        return $this->belongsTo(
            Characteristic::class
        );
    }

    public function variationAttributes(): BelongsToMany
    {
        return $this->belongsToMany(
            CharacteristicAttribute::class,
            'variation_characteristic_attributes',
            'variation_characteristic_id',
            'characteristic_attribute_slug',
            'id',
            'slug'
        );
    }
}
