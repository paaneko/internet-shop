<?php

declare(strict_types=1);

namespace App\DTOs\CategoryFilterService;

class PriceRangeUrlDto
{
    public function __construct(
        public float $min_price,
        public float $max_price,
    ) {
    }

    public static function fromUrl(string $min_price, string $max_price): self
    {
        return new self(
            /** prepare prices for db*/
            min_price: round(floatval($min_price) * 100),
            max_price: round(floatval($max_price) * 100),
        );
    }
}
