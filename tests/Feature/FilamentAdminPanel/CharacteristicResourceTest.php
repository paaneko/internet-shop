<?php

use App\Filament\Resources\CharacteristicResource;
use Database\Factories\CharacteristicFactory;
use Database\Factories\CharacteristicGroupFactory;
use Filament\Actions\DeleteAction;

use function Pest\Livewire\livewire;

//it('can render characteristic index page', function () {
//    $this->get(CharacteristicResource::getUrl('index'))
//        ->assertSuccessful();
//});

it('can list characteristics', function () {
    CharacteristicGroupFactory::new()->count(10)->create();
    $characteristic = CharacteristicFactory::new()
        ->withSortingOrder()->count(10)->create();

    livewire(CharacteristicResource\Pages\ListCharacteristics::class)
        ->assertCanSeeTableRecords($characteristic);
});

//it('can render create characteristic page', function () {
//    $this->get(CharacteristicResource::getUrl('create'))
//        ->assertSuccessful();
//});

//it('can render edit characteristic page', function () {
//    CharacteristicGroupFactory::new()->create();
//    $this->get(
//        CharacteristicResource::getUrl('edit', [
//            'record' => CharacteristicFactory::new()->create(),
//        ])
//    )->assertSuccessful();
//});

it('can retrieve characteristic data', function () {
    CharacteristicGroupFactory::new()->count(10)->create();
    $characteristic = CharacteristicFactory::new()
        ->create();

    livewire(CharacteristicResource\Pages\EditCharacteristic::class, [
        'record' => $characteristic->getRouteKey(),
    ])
        ->assertFormSet([
            'characteristic_group_id' => $characteristic->characteristic_group_id,
            'name' => $characteristic->name,
            'hint_text' => $characteristic->hint_text,
            'is_collapsed' => $characteristic->is_collapsed,
            'sorting_order' => $characteristic->sorting_order,
        ]);
});

it('can delete characteristic', function () {
    CharacteristicGroupFactory::new()->count(10)->create();
    $characteristic = CharacteristicFactory::new()->create();

    livewire(CharacteristicResource\Pages\EditCharacteristic::class, [
        'record' => $characteristic->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);

    $this->assertModelMissing($characteristic);
});
