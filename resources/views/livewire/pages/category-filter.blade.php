<div class="flex space-x-5">
    <!-- Left Sidebar (40%) -->
    <div class="w-80">
        <livewire:features.filter.filter-sidebar :$categoryFilters />
    </div>
    {{-- @dd($categoryProducts) --}}
    <!-- Right Content (60%) -->
    <div class="flex-1">
        <div class="grid grid-flow-row grid-cols-4 gap-2">
            {{-- @dd($categoryProducts) --}}
            @foreach ($categoryProducts as $variation)
                <livewire:product.product-card class="border-l-0 border-t-0" :key="$variation->id" :$variation />
            @endforeach
        </div>
        <div class="p-5">{{ $categoryProducts->links(data: ['scrollTo' => false]) }}</div>
    </div>
</div>
