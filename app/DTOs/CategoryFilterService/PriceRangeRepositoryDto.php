<?php

declare(strict_types=1);

namespace App\DTOs\CategoryFilterService;

class PriceRangeRepositoryDto
{
    public function __construct(
        public float $min_price,
        public float $max_price,
    ) {
    }

    public static function fromRepository(object $object): self
    {
        return new self(
            /** Casting raw prices prom db */
            min_price: round(floatval($object->min_price) / 100, precision: 2),
            max_price: round(floatval($object->max_price) / 100, precision: 2)
        );
    }
}
