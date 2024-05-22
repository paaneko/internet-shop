<?php

declare(strict_types=1);

namespace App\Filament\Resources\CharacteristicGroupResource\Pages;

use App\Filament\Resources\CharacteristicGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCharacteristicGroup extends EditRecord
{
    protected static string $resource = CharacteristicGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
