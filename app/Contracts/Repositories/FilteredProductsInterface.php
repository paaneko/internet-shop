<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface FilteredProductsInterface
{
    public function __construct(
        Category $category,
        int $minPrice,
        int $maxPrice,
        int $pagination
    );

    public function all(): LengthAwarePaginator;

    public function filter(Collection $attributes): LengthAwarePaginator;
}
