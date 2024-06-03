<?php

declare(strict_types=1);

use App\DTOs\CategoryFilterService\ProductFilterGroupDto;
use App\DTOs\CategoryFilterService\ProductFilterItemDto;
use App\Models\Variation;
use App\Models\VariationCharacteristic;
use App\Services\CategoryFilterService;
use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\CharacteristicAttributeFactory;
use Database\Factories\CharacteristicFactory;
use Database\Factories\CharacteristicGroupFactory;
use Database\Factories\ProductFactory;
use Database\Factories\VariationFactory;
use Illuminate\Pagination\LengthAwarePaginator;

beforeEach(function () {
    $this->brand = BrandFactory::new()
        ->create();
    $this->category = CategoryFactory::new()
        ->create([
            'id' => '9999',
        ]);

    /** means first product etc. */
    $this->p_1 = ProductFactory::new()->create([
        'category_id' => $this->category,
        'brand_id' => $this->brand,
    ]);
    $this->p_2 = ProductFactory::new()->create([
        'category_id' => $this->category,
        'brand_id' => $this->brand,
    ]);
    $this->p_3 = ProductFactory::new()->create([
        'category_id' => $this->category,
        'brand_id' => $this->brand,
    ]);
    /** means first_variation etc. */
    $this->v_1 = VariationFactory::new()->for($this->p_1)->create();
    $this->v_2 = VariationFactory::new()->for($this->p_2)->create();
    $this->v_3 = VariationFactory::new()->for($this->p_3)->create();
});

it('can count and group product filters with empty url', function () {
    $this->cg_1 = CharacteristicGroupFactory::new()->create();

    $this->c_1 = CharacteristicFactory::new()->create();

    $attribute = CharacteristicAttributeFactory::new()
        ->createWithProvidedCharacteristicId($this->c_1->id)
        ->withSortingOrder()
        ->create();

    $variationCharacteristic_one = VariationCharacteristic::factory()
        ->for($this->v_1)
        ->for($this->c_1)
        ->create();

    $variationCharacteristic_two = VariationCharacteristic::factory()
        ->for($this->v_2)
        ->for($this->c_1)
        ->create();

    $variationCharacteristic_one->variationAttributes()->attach(
        $attribute
    );

    $variationCharacteristic_two->variationAttributes()->attach(
        $attribute
    );

    $service = new CategoryFilterService($this->category, '');
    $productFilters = $service->getProductFilters();
    /** @var ProductFilterGroupDto $filterGroup */
    $filterGroup = $productFilters->data[$this->c_1->name];
    /** @var ProductFilterItemDto $filterItem */
    $filterItem = $productFilters->data[$this->c_1->name]->items->first();

    expect($filterGroup)->toBeInstanceOf(ProductFilterGroupDto::class)
        ->and($filterGroup->id)->toBe($this->c_1->id)
        ->and($filterGroup->hint_text)->toBe($this->c_1->hint_text)
        ->and($filterGroup->is_collapsed)->toBe($this->c_1->is_collapsed)
        ->and($filterItem)->toBeInstanceOf(ProductFilterItemDto::class)
        ->and($filterItem->id)->toBe($attribute->id)
        ->and($filterItem->name)->toBe($attribute->name)
        ->and($filterItem->slug)->toBe($attribute->slug)
        ->and($filterItem->count)->toBe(2)
        ->and($productFilters->data->count())->toBe(1);
});

it('can count and group product filters with separate characteristics', function () {
    $this->cg_1 = CharacteristicGroupFactory::new()->create();

    $this->c_1 = CharacteristicFactory::new()->create();
    $this->c_2 = CharacteristicFactory::new()->create();

    $this->a_1 = CharacteristicAttributeFactory::new()
        ->createWithProvidedCharacteristicId($this->c_1->id)
        ->withSortingOrder()
        ->create();

    $this->a_2 = CharacteristicAttributeFactory::new()
        ->createWithProvidedCharacteristicId($this->c_1->id)
        ->withSortingOrder()
        ->create();

    $variationCharacteristic_one = VariationCharacteristic::factory()
        ->for($this->v_1)
        ->for($this->c_1)
        ->create();

    $variationCharacteristic_two = VariationCharacteristic::factory()
        ->for($this->v_2)
        ->for($this->c_2)
        ->create();

    $variationCharacteristic_one->variationAttributes()->attach(
        $this->a_1
    );

    $variationCharacteristic_two->variationAttributes()->attach(
        $this->a_2
    );

    $service = new CategoryFilterService($this->category, '');
    $productFilters = $service->getProductFilters();
    /** @var ProductFilterGroupDto $filterGroup */
    expect($productFilters->data->count())->toBe(2);
});

it('can count and group product filters with non-empty url', function () {
    $this->cg_1 = CharacteristicGroupFactory::new()->create();

    $this->c_1 = CharacteristicFactory::new()->create();
    $this->c_2 = CharacteristicFactory::new()->create();

    $this->a_1 = CharacteristicAttributeFactory::new()
        ->createWithProvidedCharacteristicId($this->c_1->id)
        ->withSortingOrder()
        ->create();

    $this->a_2 = CharacteristicAttributeFactory::new()
        ->createWithProvidedCharacteristicId($this->c_1->id)
        ->withSortingOrder()
        ->create();

    $variationCharacteristic_one = VariationCharacteristic::factory()
        ->for($this->v_1)
        ->for($this->c_1)
        ->create();

    $variationCharacteristic_two = VariationCharacteristic::factory()
        ->for($this->v_2)
        ->for($this->c_2)
        ->create();

    $variationCharacteristic_one->variationAttributes()->attach(
        $this->a_1
    );

    $variationCharacteristic_two->variationAttributes()->attach(
        $this->a_2
    );

    $service = new CategoryFilterService($this->category, $this->a_1->slug);
    $productFilters = $service->getProductFilters();

    /** @var ProductFilterGroupDto $filterGroup */
    expect($productFilters->data->count())->toBe(1)
        ->and($productFilters->data->first()->hint_text)->toBe($this->c_1->hint_text);

});

it('can return filtered products with empty url', function () {
    $this->cg_1 = CharacteristicGroupFactory::new()->create();

    $this->c_1 = CharacteristicFactory::new()->create();

    $attribute = CharacteristicAttributeFactory::new()
        ->createWithProvidedCharacteristicId($this->c_1->id)
        ->withSortingOrder()
        ->create();

    $variationCharacteristic_one = VariationCharacteristic::factory()
        ->for($this->v_1)
        ->for($this->c_1)
        ->create();

    $variationCharacteristic_two = VariationCharacteristic::factory()
        ->for($this->v_2)
        ->for($this->c_1)
        ->create();

    $variationCharacteristic_one->variationAttributes()->attach(
        $attribute
    );

    $variationCharacteristic_two->variationAttributes()->attach(
        $attribute
    );

    $service = new CategoryFilterService($this->category, '');
    /** @var LengthAwarePaginator<Variation> $filteredProducts */
    $filteredProducts = $service->getFilteredProducts();

    expect($filteredProducts)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($filteredProducts->first()->product_id)->toBe($this->p_1->id)
        ->and($filteredProducts->first()->product->category_id)->toBe($this->category->id)
        ->and($filteredProducts->count())->toBe(3);
});

it('can return product filters with non-empty url', function () {
    $this->cg_1 = CharacteristicGroupFactory::new()->create();

    $this->c_1 = CharacteristicFactory::new()->create();
    $this->c_2 = CharacteristicFactory::new()->create();

    $this->a_1 = CharacteristicAttributeFactory::new()
        ->createWithProvidedCharacteristicId($this->c_1->id)
        ->withSortingOrder()
        ->create();

    $this->a_2 = CharacteristicAttributeFactory::new()
        ->createWithProvidedCharacteristicId($this->c_1->id)
        ->withSortingOrder()
        ->create();

    $variationCharacteristic_one = VariationCharacteristic::factory()
        ->for($this->v_1)
        ->for($this->c_1)
        ->create();

    $variationCharacteristic_two = VariationCharacteristic::factory()
        ->for($this->v_2)
        ->for($this->c_2)
        ->create();

    $variationCharacteristic_one->variationAttributes()->attach(
        $this->a_1
    );

    $variationCharacteristic_two->variationAttributes()->attach(
        $this->a_2
    );

    $service = new CategoryFilterService($this->category, $this->a_1->slug);
    $filteredProducts = $service->getFilteredProducts();

    /** @var ProductFilterGroupDto $filterGroup */
    expect($filteredProducts->count())->toBe(1)
        ->and($filteredProducts->first()->name)->toBe($this->v_1->name);

});
