<?php

declare(strict_types=1);

namespace App\DTOs\CategoryFilterService;

use Illuminate\Support\Collection;

class ProductFilterGroupDto
{
    public function __construct(
        public int $id,
        public ?string $hint_text,
        public bool $is_collapsed,
        /** @var Collection<ProductFilterItemDto> */
        public Collection $items,
    ) {
    }
}
