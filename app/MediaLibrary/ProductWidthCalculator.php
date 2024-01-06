<?php

namespace App\MediaLibrary;

use Illuminate\Support\Collection;
use Spatie\MediaLibrary\ResponsiveImages\WidthCalculator\WidthCalculator;

class ProductWidthCalculator implements WidthCalculator
{
    // TODO implement calculation logic for both methods
    public function calculateWidthsFromFile(string $imagePath): Collection
    {
        return collect([500, 1000, 1500]);
    }

    public function calculateWidths(
        int $fileSize,
        int $width,
        int $height
    ): Collection {
        return collect([500, 1000, 1250, 1500]);
    }
}
