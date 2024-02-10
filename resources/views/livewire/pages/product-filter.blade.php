<div class="flex">
    <!-- Left Sidebar (40%) -->
    <div class="w-96 border">
        @foreach($categoryFilters as $filterName => $filterAttributes)
            <div class="collapse-arrow join-item border border-base-300">
                <div class="collapse-title text-xl font-medium">
                    {{ $filterName }}
                </div>
                <div class="form-control p-4">
                    @foreach($filterAttributes as $attribute)
                        <a href="{{ asset($attribute['url']) }}" class="label cursor-pointer">
                            <input type="checkbox"
                                   @if(($attribute['is_selected'])) checked @endif
                                   class="checkbox checkbox-primary" />
                            <span class="label-text">{{ $attribute['name'] }}</span>
                            <span class="label-text">({{ $attribute['count'] }})</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    {{--    @dd($categoryProducts)--}}
    <!-- Right Content (60%) -->
    <div class="flex-1">
        <livewire:categories-list />
        <div class="grid grid-cols-4 grid-flow-row">
            @foreach($categoryProducts as $product)
                <livewire:product.product-card
                    class="border-l-0 border-t-0"
                    :key="$product->id"
                    :$product
                />
            @endforeach
        </div>
        <div class="p-5">{{ $categoryProducts->links(data: ['scrollTo' => false]) }}</div>
    </div>
</div>
