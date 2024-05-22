<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductFaq extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'question',
            'answer',
            'sorting_order',
        ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
