<?php

namespace App\DTOs\CheckoutService;

use Illuminate\Support\Collection;
use Stripe\Collection as StripeCollection;
use Stripe\LineItem;

class StripeLineItemsDto
{
    public function __construct(public Collection $data)
    {
    }

    public static function fromStripeCollection(StripeCollection $collection
    ): self {
        return new self(
            data: collect($collection->all())->map(
                fn (LineItem $lineItem) => new LineItemDto(
                    price: $lineItem->price->unit_amount,
                    product: $lineItem->price->product,
                    quantity: $lineItem->quantity,
                    amount_discount: $lineItem->amount_discount,
                    amount_subtotal: $lineItem->amount_total,
                    amount_total: $lineItem->amount_total
                )
            )
        );
    }
}
