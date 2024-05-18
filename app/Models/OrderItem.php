<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'order_id',
            'item_id',
            'item_type',
            'variation_id',
            'name',
            'quantity',
            'discount',
            'price',
            'sub_total',
            'total',
        ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
