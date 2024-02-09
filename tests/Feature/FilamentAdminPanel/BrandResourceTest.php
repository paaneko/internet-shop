<?php

use App\Filament\Resources\BrandResource;
use App\Models\Brand;
use Database\Factories\BrandFactory;
use Filament\Actions\DeleteAction;

use function Pest\Livewire\livewire;

//it('can render brand index page', function () {
//    $this->get(BrandResource::getUrl('index'))
//        ->assertSuccessful();
//});

it('can list brands', function () {
    $brand = BrandFactory::new()->count(10)->create();

    livewire(BrandResource\Pages\ListBrands::class)
        ->assertCanSeeTableRecords($brand);
});

//it('can render create brand page', function () {
//    $this->get(BrandResource::getUrl('create'))
//        ->assertSuccessful();
//});

it('can create brand', function () {
    $newData
        = BrandFactory::new()
            ->make();

    livewire(BrandResource\Pages\CreateBrand::class)
        ->fillForm([
            'name' => $newData->name,
            'slug' => $newData->slug,
            'meta_tag_h1' => $newData->meta_tag_h1,
            'meta_tag_title' => $newData->meta_tag_title,
            'meta_tag_description' => $newData->meta_tag_description,
            'description' => $newData->description,
            'indexation' => $newData->indexation,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(Brand::class, [
        'name' => $newData->name,
        'slug' => $newData->slug,
        'meta_tag_h1' => $newData->meta_tag_h1,
        'meta_tag_title' => $newData->meta_tag_title,
        'meta_tag_description' => $newData->meta_tag_description,
        'description' => $newData->description,
        'indexation' => $newData->indexation,
    ]);
});

//it('can render edit brand page', function () {
//    $this->get(
//        BrandResource::getUrl('edit', [
//            'record' => BrandFactory::new()->create(),
//        ])
//    )->assertSuccessful();
//});

it('can retrieve brand data', function () {
    $brand = BrandFactory::new()
        ->create();

    livewire(BrandResource\Pages\EditBrand::class, [
        'record' => $brand->getRouteKey(),
    ])
        ->assertFormSet([
            'name' => $brand->name,
            'slug' => $brand->slug,
            'meta_tag_h1' => $brand->meta_tag_h1,
            'meta_tag_title' => $brand->meta_tag_title,
            'meta_tag_description' => $brand->meta_tag_description,
            'description' => $brand->description,
            'indexation' => $brand->indexation,
        ]);
});

it('can edit existing brand', function () {
    $brand = BrandFactory::new()
        ->create();

    $newData = BrandFactory::new()
        ->make();

    livewire(BrandResource\Pages\EditBrand::class, [
        'record' => $brand->getRouteKey(),
    ])
        ->fillForm([
            'name' => $newData->name,
            'slug' => $newData->slug,
            'meta_tag_h1' => $newData->meta_tag_h1,
            'meta_tag_title' => $newData->meta_tag_title,
            'meta_tag_description' => $newData->meta_tag_description,
            'description' => $newData->description,
            'indexation' => $newData->indexation,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $brand->refresh();

    $this->assertEquals($newData->name, $brand->name);
    $this->assertEquals($newData->slug, $brand->slug);
    $this->assertEquals($newData->meta_tag_h1, $brand->meta_tag_h1);
    $this->assertEquals($newData->meta_tag_title, $brand->meta_tag_title);
    $this->assertEquals(
        $newData->meta_tag_description,
        $brand->meta_tag_description
    );
    $this->assertEquals($newData->description, $brand->description);
    $this->assertEquals($newData->indexation, $brand->indexation);
});

it('can delete brand', function () {
    $brand = BrandFactory::new()->create();

    livewire(BrandResource\Pages\EditBrand::class, [
        'record' => $brand->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);

    $this->assertModelMissing($brand);
});
