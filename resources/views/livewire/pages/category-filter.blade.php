<div class="flex space-x-5">
    <!-- Left Sidebar (40%) -->
    <div class="w-80">
        <livewire:features.filter.filter-sidebar :$selectedFilterItems :$productFilter :$priceRange :$url />
    </div>
    <!-- Right Content (60%) -->
    <div class="flex-1">
        <x-shared.ui.product-list-wrapper>
            @foreach ($filteredProducts as $product)
                <livewire:product.product-card
                    class="border-l-0 border-t-0"
                    :key="$product->id"
                    :variation="$product"
                />
            @endforeach
        </x-shared.ui.product-list-wrapper>
        <div class="p-5">{{ $filteredProducts->links(data: ['scrollTo' => false]) }}</div>
    </div>
</div>
