<?php

declare(strict_types=1);

namespace App\Filament\Shared\ProductResource;

use App\Models\Characteristic;

trait GetCharacteristicLabel
{
    public static function getCharacteristicLabel(int|string|null $id): string
    {
        $characteristic
            = Characteristic::with(
                'characteristicGroup'
            )->find($id);

        if (! $characteristic) {
            return '';
        }

        return $characteristic->characteristicGroup->name
            . ' > ' . $characteristic->name;
    }
}
