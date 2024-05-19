<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $casts
        = [
            'price' => MoneyCast::class,
            'discount' => MoneyCast::class,
            'sub_total' => MoneyCast::class,
            'total' => MoneyCast::class,
        ];

    protected $fillable
        = [
            'order_id',
            'item_id',
            'item_type',
            'variation_id',
            'name',
            'color',
            'sku',
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
