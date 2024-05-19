<?php

namespace App\DTOs\CheckoutService;

use Stripe\Product;

class StripeLineItemProductDto
{
    public function __construct(
        public string $name,
        public string $item_id,
        public string $color,
        public string $sku,
        public string $item_type,
    ) {
    }

    public static function fromLineItemProduct(Product $product): self
    {
        return new self(
            name: $product->name,
            item_id: $product->metadata->item_id,
            color: $product->metadata->color,
            sku: $product->metadata->sku,
            item_type: $product->metadata->item_type,
        );
    }
}
