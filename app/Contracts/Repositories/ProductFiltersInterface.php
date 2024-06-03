<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\Models\Category;
use Illuminate\Support\Collection;

interface ProductFiltersInterface
{
    public function __construct(Category $category);

    public function all(): Collection;

    public function filter(Collection $attributes): Collection;
}
