<?php

namespace App\DTOs\CheckoutService;

class LineItemDto
{
    public function __construct(
        public int $price,
        public string $product,
        public int $quantity,
        public int $amount_discount,
        public int $amount_subtotal,
        public int $amount_total,
    ) {
    }
}
