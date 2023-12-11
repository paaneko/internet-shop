<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CharacteristicGroup extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'name',
            'sorting_order',
        ];

    public function characteristic(): HasMany
    {
        return $this->hasMany(Characteristic::class);
    }
}
