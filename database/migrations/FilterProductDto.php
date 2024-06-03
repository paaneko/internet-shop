<?php

declare(strict_types=1);

namespace Database\migrations;

class FilterProductDto
{
    public function __construct(
        public int $id,
        public bool $selected,
        public bool $slug,

    ) {
    }
}
