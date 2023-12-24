<?php

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Database\Factories\BrandFactory;
use Database\Factories\ProductFactory;
use Filament\Actions\DeleteAction;

use function Pest\Livewire\livewire;

it('can render product index page', function () {
    $this->get(ProductResource::getUrl('index'))
        ->assertSuccessful();
});

it('can list products', function () {
    $posts = ProductFactory::new()->count(10)
        ->for(BrandFactory::new()->create(), 'brand')
        ->create();
    livewire(ProductResource\Pages\ListProducts::class)
        ->assertCanSeeTableRecords($posts);
});

it('can render create product page', function () {
    $this->get(ProductResource::getUrl('create'))->assertSuccessful();
});

it('can create product', function () {
    $newData
        = ProductFactory::new()
            ->for(BrandFactory::new()->create())
            ->make();

    livewire(ProductResource\Pages\CreateProduct::class)
        ->fillForm([
            'brand_id' => $newData->brand->id,
            'name' => $newData->name,
            'slug' => $newData->slug,
            'meta_tag_h1' => $newData->meta_tag_h1,
            'meta_tag_title' => $newData->meta_tag_title,
            'meta_tag_description' => $newData->meta_tag_description,
            'description' => $newData->description,
            'product_code' => $newData->product_code,
            'sku' => $newData->sku,
            'upc' => $newData->upc,
            'ean' => $newData->ean,
            'jan' => $newData->jan,
            'mpn' => $newData->mpn,
            'price' => $newData->price,
            'count' => $newData->count,
            'indexation' => $newData->indexation,
            'status' => $newData->status->value,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(Product::class, [
        'brand_id' => $newData->brand->id,
        'name' => $newData->name,
        'slug' => $newData->slug,
        'meta_tag_h1' => $newData->meta_tag_h1,
        'meta_tag_title' => $newData->meta_tag_title,
        'meta_tag_description' => $newData->meta_tag_description,
        'description' => $newData->description,
        'product_code' => $newData->product_code,
        'sku' => $newData->sku,
        'upc' => $newData->upc,
        'ean' => $newData->ean,
        'jan' => $newData->jan,
        'mpn' => $newData->mpn,
        'price' => round(floatval($newData->price) * 100),
        'count' => $newData->count,
        'indexation' => $newData->indexation,
        'status' => $newData->status->value,
    ]);
});

// TODO create test that ensures that data is properly validated in a form:

it('can render edit product page', function () {
    $this->get(
        ProductResource::getUrl('edit', [
            'record' => ProductFactory::new()->create(),
        ])
    )->assertSuccessful();
});

it('can retrieve product data', function () {
    $product = ProductFactory::new()
        ->for(BrandFactory::new()->create())
        ->create();

    livewire(ProductResource\Pages\EditProduct::class, [
        'record' => $product->getRouteKey(),
    ])
        ->assertFormSet([
            'brand_id' => $product->brand->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'meta_tag_h1' => $product->meta_tag_h1,
            'meta_tag_title' => $product->meta_tag_title,
            'meta_tag_description' => $product->meta_tag_description,
            'description' => $product->description,
            'product_code' => $product->product_code,
            'sku' => $product->sku,
            'upc' => $product->upc,
            'ean' => $product->ean,
            'jan' => $product->jan,
            'mpn' => $product->mpn,
            'price' => $product->price,
            'count' => $product->count,
            'indexation' => $product->indexation,
            'status' => $product->status->value,
        ]);
});

it('can edit existing product', function () {
    $product = ProductFactory::new()
        ->for(BrandFactory::new()->create())->create();

    $newData = ProductFactory::new()
        ->for(BrandFactory::new()->create())->make();

    livewire(ProductResource\Pages\EditProduct::class, [
        'record' => $product->getRouteKey(),
    ])
        ->fillForm([
            'brand_id' => $newData->brand->id,
            'name' => $newData->name,
            'slug' => $newData->slug,
            'meta_tag_h1' => $newData->meta_tag_h1,
            'meta_tag_title' => $newData->meta_tag_title,
            'meta_tag_description' => $newData->meta_tag_description,
            'description' => $newData->description,
            'product_code' => $newData->product_code,
            'sku' => $newData->sku,
            'upc' => $newData->upc,
            'ean' => $newData->ean,
            'jan' => $newData->jan,
            'mpn' => $newData->mpn,
            'price' => $newData->price,
            'count' => $newData->count,
            'indexation' => $newData->indexation,
            'status' => $newData->status->value,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $product->refresh();

    $this->assertEquals($newData->brand->id, $product->brand_id);
    $this->assertEquals($newData->name, $product->name);
    $this->assertEquals($newData->slug, $product->slug);
    $this->assertEquals($newData->meta_tag_h1, $product->meta_tag_h1);
    $this->assertEquals($newData->meta_tag_title, $product->meta_tag_title);
    $this->assertEquals(
        $newData->meta_tag_description,
        $product->meta_tag_description
    );
    $this->assertEquals($newData->description, $product->description);
    $this->assertEquals($newData->product_code, $product->product_code);
    $this->assertEquals($newData->sku, $product->sku);
    $this->assertEquals($newData->upc, $product->upc);
    $this->assertEquals($newData->ean, $product->ean);
    $this->assertEquals($newData->jan, $product->jan);
    $this->assertEquals($newData->mpn, $product->mpn);
    $this->assertEquals($newData->price, $product->price);
    $this->assertEquals($newData->count, $product->count);
    $this->assertEquals($newData->indexation, $product->indexation);
    $this->assertEquals($newData->status->value, $product->status->value);
});

it('can delete product', function () {
    $product = ProductFactory::new()->create();

    livewire(ProductResource\Pages\EditProduct::class, [
        'record' => $product->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);

    $this->assertModelMissing($product);
});
