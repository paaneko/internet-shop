<div class="flex">
    <!-- Left Sidebar (40%) -->
    <div class="w-96 border">
        @foreach ($categoryFilters as $filterName => $filterAttributes)
            <div class="join-item collapse-arrow border border-base-300">
                <div class="collapse-title text-xl font-medium">
                    {{ $filterName }}
                </div>
                <div class="form-control p-4">
                    @foreach ($filterAttributes as $attribute)
                        <a href="{{ asset($attribute['url']) }}" class="label cursor-pointer">
                            <input
                                type="checkbox"
                                @if(($attribute['is_selected'])) checked @endif
                                class="checkbox-primary checkbox"
                            />
                            <span class="label-text">{{ $attribute['name'] }}</span>
                            <span class="label-text">({{ $attribute['count'] }})</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    {{-- @dd($categoryProducts) --}}
    <!-- Right Content (60%) -->
    <div class="flex-1">
        <livewire:categories-list />
        <div class="grid grid-flow-row grid-cols-4">
            {{-- @dd($categoryProducts) --}}
            @foreach ($categoryProducts as $variation)
                <livewire:product.product-card class="border-l-0 border-t-0" :key="$variation->id" :$variation />
            @endforeach
        </div>
        <div class="p-5">{{ $categoryProducts->links(data: ['scrollTo' => false]) }}</div>
    </div>
</div>
