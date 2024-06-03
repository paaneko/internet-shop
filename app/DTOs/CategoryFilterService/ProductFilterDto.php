<?php

declare(strict_types=1);

namespace App\DTOs\CategoryFilterService;

use Illuminate\Support\Collection;

class ProductFilterDto
{
    public function __construct(
        /** @var Collection<string, ProductFilterGroupDto> */
        public Collection $data,
    ) {
    }

    public static function fromCollection(Collection $collection): self
    {
        return new self(
            data: $collection->sortBy('id')
                ->groupBy('characteristic_name')
                ->map(fn ($items) => new ProductFilterGroupDto(
                    id: $items->first()->id,
                    hint_text: $items->first()->characteristic_hint_text,
                    is_collapsed: $items->first()->characteristic_is_collapsed,
                    items: $items->sortBy('attribute_id')
                        ->map(fn ($item) => new ProductFilterItemDto(
                            id: $item->attribute_id,
                            name: $item->attribute_name,
                            slug: $item->attribute_slug,
                            count: $item->attribute_count,
                        ))
                ))
        );
    }
}
