<?php

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

    public function productCharacteristics(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductCharacteristic::class,
            'product_characteristic_attributes',
            'characteristic_attribute_id',
            'product_characteristic_id',
        );
    }
}
