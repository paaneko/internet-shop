<?php

namespace App\DTOs\CheckoutService;

use Stripe\Product;

class StripeLineItemProductDto
{
    public function __construct(
        public string $name,
        public string $item_id,
        public string $item_type,
    ) {
    }

    public static function fromLineItemProduct(Product $product): self
    {
        return new self(
            name: $product->name,
            item_id: $product->metadata->item_id,
            item_type: $product->metadata->item_type,
        );
    }
}
