@php
    use Spatie\Url\Url;
@endphp

<div
    class="relative mx-auto w-full overflow-hidden rounded-md border border-neutral-400/70 bg-white text-sm font-normal"
>
    <div class="p-5 text-center text-xl font-semibold">Product filter</div>
    <div class="mx-4 h-[1px] w-auto bg-neutral-200/70"></div>
    <x-entities.filter.filter-item-collapce-wrapper label="Price">
        <x-entities.filter.filter-price-range :$selectedPriceRange :$priceRange>
            <x-slot name="submitButtonSlot">
                <x-shared.ui.button
                    x-on:click="$wire.setPriceRange(minprice, maxprice)"
                    class="bg-lime-500 px-3 py-2 text-white hover:bg-lime-600"
                >
                    <p>OK</p>
                </x-shared.ui.button>
            </x-slot>
        </x-entities.filter.filter-price-range>
    </x-entities.filter.filter-item-collapce-wrapper>
    @foreach ($productFilter->data as $filterGroupName => $filterGroup)
        <div class="mx-4 h-[1px] w-auto bg-neutral-200/70"></div>
        <x-entities.filter.filter-item-collapce-wrapper label="{{$filterGroupName}}">
            <div class="form-control flex flex-col px-3 py-5 pt-0">
                @foreach ($filterGroup->items as $filterItem)
                    @php
                        $spatieUrl = Url::fromString($url);
                        $queryParameters = $spatieUrl->getQuery();
                        $segments = collect($spatieUrl->getSegments());

                        // if segment equals false that mean it's not checked
                        $segmentKey = $selectedFilterItems->search($filterItem->slug);

                        is_int($segmentKey) ? $segments->forget($segmentKey + 1) : $segments->push($filterItem->slug);

                        $filterUrl = $segments->implode('/');
                    @endphp

                    <a
                        wire:navigate
                        href="{{ asset($filterUrl) }}"
                        class="flex items-center rounded-md py-2 hover:bg-lime-100/70"
                    >
                        <div class="flex h-5 cursor-pointer items-center">
                            <input
                                name="{{ $filterItem->id }}"
                                id="{{ $filterItem->id }}"
                                type="checkbox"
                                class="peer hidden"
                                @if(is_int($segmentKey)) checked @endif
                            />
                            <label
                                for="{{ $filterItem->id }}"
                                class="ml-2 flex cursor-pointer select-none items-center space-x-4 text-neutral-700 peer-checked:text-neutral-700 peer-checked:[&_.custom-checkbox]:border-lime-600 peer-checked:[&_.custom-checkbox]:bg-lime-600 [&_svg]:scale-0 peer-checked:[&_svg]:scale-100"
                            >
                                <span
                                    class="custom-checkbox flex h-5 w-5 items-center justify-center rounded border-2 border-neutral-500"
                                >
                                    @svg('heroicon-s-check', 'h-4 w-4 text-white duration-300 ease-out')
                                </span>
                                <div>
                                    <span>{{ $filterItem->name }}</span>
                                    <span class="text-gray-400">({{ $filterItem->count }})</span>
                                </div>
                            </label>
                        </div>
                    </a>
                @endforeach
            </div>
        </x-entities.filter.filter-item-collapce-wrapper>
    @endforeach
</div>
