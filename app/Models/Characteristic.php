<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Characteristic extends Model
{
    use HasFactory;

    protected $casts
        = [
            'is_collapsed' => 'boolean',
        ];

    protected $fillable
        = [
            'characteristic_group_id',
            'name',
            'hint_text',
            'is_collapsed',
            'sorting_order',
        ];

    public function characteristicGroup(): BelongsTo
    {
        return $this->belongsTo(
            CharacteristicGroup::class,
            'characteristic_group_id'
        );
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(CharacteristicAttribute::class);
    }

    public function productsCharacteristics(): HasMany
    {
        return $this->hasMany(VariationCharacteristic::class);
    }
}
