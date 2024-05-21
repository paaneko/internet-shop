<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $casts
        = [
            'billing_address' => 'collection',
            'shipping_address' => 'collection',
            'amount_total' => MoneyCast::class,
            'amount_subtotal' => MoneyCast::class,
            'amount_discount' => MoneyCast::class,
            'amount_shipping' => MoneyCast::class,
        ];

    protected $fillable
        = [
            'user_id',
            'order_number',
            'stripe_checkout_session_id',
            'amount_shipping',
            'amount_discount',
            'amount_subtotal',
            'amount_total',
            'billing_address',
            'shipping_address',
        ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
