<?php

declare(strict_types=1);

namespace App\Filament\Resources\VariationResource\Pages;

use App\Filament\Resources\VariationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVariation extends CreateRecord
{
    protected static string $resource = VariationResource::class;
}
