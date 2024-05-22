<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CharacteristicAttribute extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'name',
            'characteristic_id',
            'sorting_order',
        ];

    public function characteristic(): BelongsTo
    {
        return $this->belongsTo(Characteristic::class);
    }

    public function variationCharacteristics(): BelongsToMany
    {
        return $this->belongsToMany(
            VariationCharacteristic::class,
            'variation_characteristic_attributes',
            'characteristic_attribute_id',
            'variation_characteristic_id',
        );
    }
}
