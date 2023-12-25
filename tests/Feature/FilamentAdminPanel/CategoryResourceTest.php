<?php

use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use Database\Factories\CategoryFactory;

use function Pest\Livewire\livewire;

it('can render category index page', function () {
    $this->get(CategoryResource::getUrl('index'))
        ->assertSuccessful();
});

it('can list categories', function () {
    $category = CategoryFactory::new()
        ->createOptionalWithParentCategory()
        ->count(10)->create();

    livewire(CategoryResource\Pages\ListCategories::class)
        ->assertCanSeeTableRecords($category);
});

it('can render create brand page', function () {
    $this->get(CategoryResource::getUrl('create'))
        ->assertSuccessful();
});

it('can create category', function () {
    CategoryFactory::new()->count(3)->create();
    $newData
        = CategoryFactory::new()
            ->createOptionalWithParentCategory()
            ->make();

    livewire(CategoryResource\Pages\CreateCategory::class)
        ->fillForm([
            'parent_id' => $newData->parent_id,
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

    $this->assertDatabaseHas(Category::class, [
        'parent_id' => $newData->parent_id,
        'name' => $newData->name,
        'slug' => $newData->slug,
        'meta_tag_h1' => $newData->meta_tag_h1,
        'meta_tag_title' => $newData->meta_tag_title,
        'meta_tag_description' => $newData->meta_tag_description,
        'description' => $newData->description,
        'indexation' => $newData->indexation,
    ]);
});

it('can render edit brand page', function () {
    $this->get(
        CategoryResource::getUrl('edit', [
            'record' => CategoryFactory::new()->create(),
        ])
    )->assertSuccessful();
});

it('can retrieve category data', function () {
    CategoryFactory::new()->count(3)->create();
    $category = CategoryFactory::new()
        ->createOptionalWithParentCategory()
        ->create();

    livewire(CategoryResource\Pages\EditCategory::class, [
        'record' => $category->getRouteKey(),
    ])
        ->assertFormSet([
            'parent_id' => $category->parent_id,
            'name' => $category->name,
            'slug' => $category->slug,
            'meta_tag_h1' => $category->meta_tag_h1,
            'meta_tag_title' => $category->meta_tag_title,
            'meta_tag_description' => $category->meta_tag_description,
            'description' => $category->description,
            'indexation' => $category->indexation,
        ]);
});

it('can edit existing category', function () {
    CategoryFactory::new()->count(3)->create();
    $category = CategoryFactory::new()
        ->createOptionalWithParentCategory()
        ->create();

    $newData = CategoryFactory::new()
        ->createOptionalWithParentCategory()
        ->make();

    livewire(CategoryResource\Pages\EditCategory::class, [
        'record' => $category->getRouteKey(),
    ])
        ->fillForm([
            'parent_id' => $newData->parent_id,
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

    $category->refresh();

    $this->assertEquals($newData->name, $category->name);
    $this->assertEquals($newData->slug, $category->slug);
    $this->assertEquals($newData->meta_tag_h1, $category->meta_tag_h1);
    $this->assertEquals($newData->meta_tag_title, $category->meta_tag_title);
    $this->assertEquals(
        $newData->meta_tag_description,
        $category->meta_tag_description
    );
    $this->assertEquals($newData->description, $category->description);
    $this->assertEquals($newData->indexation, $category->indexation);
});

it('can delete category', function () {
    CategoryFactory::new()->count(3)->create();
    $category = CategoryFactory::new()->create();

    livewire(CategoryResource\Pages\EditCategory::class, [
        'record' => $category->getRouteKey(),
    ])
        ->callAction(\Filament\Actions\DeleteAction::class);

    $this->assertModelMissing($category);
});
