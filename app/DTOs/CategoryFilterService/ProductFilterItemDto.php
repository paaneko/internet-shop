<?php

declare(strict_types=1);

namespace App\DTOs\CategoryFilterService;

class ProductFilterItemDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $slug,
        public int $count,
    ) {
    }
}
