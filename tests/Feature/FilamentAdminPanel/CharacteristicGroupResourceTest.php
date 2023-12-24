<?php

use App\Filament\Resources\CharacteristicGroupResource;
use App\Models\CharacteristicGroup;
use Database\Factories\CharacteristicGroupFactory;
use Filament\Actions\DeleteAction;

use function Pest\Livewire\livewire;

it('can render characteristic group index page', function () {
    $this->get(
        CharacteristicGroupResource::getUrl('index')
    )
        ->assertSuccessful();
});

it('can list characteristic group', function () {
    $characteristicGroup = CharacteristicGroupFactory::new()->count(10)->create(
    );

    livewire(CharacteristicGroupResource\Pages\ListCharacteristicGroups::class)
        ->assertCanSeeTableRecords($characteristicGroup);
});

it('can render create characteristic group page', function () {
    $this->get(CharacteristicGroupResource::getUrl('create'))
        ->assertSuccessful();
});

it('can create characteristic group', function () {
    $newData
        = CharacteristicGroupFactory::new()
            ->withSortingOrder()
            ->make();

    livewire(CharacteristicGroupResource\Pages\CreateCharacteristicGroup::class)
        ->fillForm([
            'name' => $newData->name,
            'sorting_order' => $newData->sorting_order,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(CharacteristicGroup::class, [
        'name' => $newData->name,
        'sorting_order' => $newData->sorting_order,
    ]);
});

it('can render edit characteristic group page', function () {
    $this->get(
        CharacteristicGroupResource::getUrl('edit', [
            'record' => CharacteristicGroupFactory::new()->create(),
        ])
    )->assertSuccessful();
});

it('can retrieve characteristic group data', function () {
    $characteristicGroup = CharacteristicGroupFactory::new()
        ->create();

    livewire(CharacteristicGroupResource\Pages\EditCharacteristicGroup::class, [
        'record' => $characteristicGroup->getRouteKey(),
    ])
        ->assertFormSet([
            'name' => $characteristicGroup->name,
            'sorting_order' => $characteristicGroup->sorting_order,
        ]);
});

it('can edit existing characteristic group', function () {
    $characteristicGroup = CharacteristicGroupFactory::new()
        ->withSortingOrder()
        ->create();

    $newData = CharacteristicGroupFactory::new()
        ->withSortingOrder()
        ->make();

    livewire(CharacteristicGroupResource\Pages\EditCharacteristicGroup::class, [
        'record' => $characteristicGroup->getRouteKey(),
    ])
        ->fillForm([
            'name' => $newData->name,
            'sorting_order' => $newData->sorting_order,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $characteristicGroup->refresh();

    $this->assertEquals($newData->name, $characteristicGroup->name);
    $this->assertEquals(
        $newData->sorting_order,
        $characteristicGroup->sorting_order
    );
});

it('can delete characteristic group', function () {
    $characteristicGroup = CharacteristicGroupFactory::new()
        ->withSortingOrder()
        ->create();

    livewire(CharacteristicGroupResource\Pages\EditCharacteristicGroup::class, [
        'record' => $characteristicGroup->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);

    $this->assertModelMissing($characteristicGroup);
});
