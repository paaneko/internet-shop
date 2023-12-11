<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductCharacteristic extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'characteristic_id',
            'sorting_order',
        ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function characteristic(): BelongsTo
    {
        return $this->belongsTo(
            Characteristic::class
        );
    }

    public function productAttributes(): BelongsToMany
    {
        return $this->belongsToMany(
            CharacteristicAttribute::class,
            'product_characteristic_attributes',
            'product_characteristic_id',
            'characteristic_attribute_id',
        );
    }
}
