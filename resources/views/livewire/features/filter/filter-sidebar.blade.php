@php
    use Spatie\Url\Url;
@endphp

<div
    class="relative mx-auto w-full overflow-hidden rounded-md border border-neutral-400/70 bg-white text-sm font-normal"
>
    <div class="p-5 text-center text-xl font-semibold">Product filter</div>
    <div class="flex w-full items-center justify-center p-5">
        <div
            x-data="{
                minprice: {{ $selectedPriceRange['min'] }},
                maxprice: {{ $selectedPriceRange['max'] }},
                min: {{ $priceRange->min_price }},
                max: {{ $priceRange->max_price }},
                minthumb: 0,
                maxthumb: 0,
                mintrigger() {
                    this.minprice = Math.min(this.minprice, this.maxprice - 100)
                    this.minthumb =
                        2 + ((this.minprice - this.min) / (this.max - this.min)) * 100
                },
                maxtrigger() {
                    this.maxprice = Math.max(this.maxprice, this.minprice + 100)
                    this.maxthumb =
                        104 - ((this.maxprice - this.min) / (this.max - this.min)) * 100
                },
            }"
            x-init="
                mintrigger()
                maxtrigger()
            "
            class="relative w-full max-w-xl"
        >
            <div>
                <input
                    type="range"
                    step="10"
                    x-bind:min="min"
                    x-bind:max="max"
                    x-on:input="mintrigger"
                    x-model="minprice"
                    class="pointer-events-none absolute z-20 h-2 w-full cursor-pointer appearance-none opacity-0"
                />

                <input
                    type="range"
                    step="10"
                    x-bind:min="min"
                    x-bind:max="max"
                    x-on:input="maxtrigger"
                    x-model="maxprice"
                    class="pointer-events-none absolute z-20 h-2 w-full cursor-pointer appearance-none opacity-0"
                />

                <div class="relative z-10 h-2">
                    <div class="absolute bottom-0 left-0 right-0 top-0 z-10 rounded-md bg-gray-200"></div>

                    <div
                        class="absolute bottom-0 top-0 z-20 rounded-md bg-lime-500"
                        x-bind:style="'right:' + maxthumb + '%; left:' + minthumb + '%'"
                    ></div>

                    <div
                        class="absolute left-0 top-0 z-30 -ml-1 -mt-2 h-6 w-6 rounded-full bg-lime-600"
                        x-bind:style="'left: ' + minthumb + '%'"
                    ></div>
                    <div
                        class="absolute right-0 top-0 z-30 -mr-3 -mt-2 h-6 w-6 rounded-full bg-lime-600"
                        x-bind:style="'right: ' + maxthumb + '%'"
                    ></div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-7">
                <div>
                    <input
                        type="text"
                        maxlength="5"
                        x-on:input="mintrigger"
                        x-model="minprice"
                        class="w-24 rounded border border-gray-200 px-3 py-2 text-center"
                    />
                </div>
                <div>-</div>
                <div>
                    <input
                        type="text"
                        maxlength="5"
                        x-on:input="maxtrigger"
                        x-model="maxprice"
                        class="w-24 rounded border border-gray-200 px-3 py-2 text-center"
                    />
                </div>
            </div>
            <x-shared.ui.button
                x-on:click="$wire.setPriceRange(minprice, maxprice)"
                class="bg-lime-500 px-3 py-2 text-white hover:bg-lime-600"
            >
                <p>OK</p>
            </x-shared.ui.button>
        </div>
    </div>
    @foreach ($productFilter->data as $filterGroupName => $filterGroup)
        <div class="mx-4 h-[1px] w-auto bg-neutral-200/70"></div>

        <div x-data="{ open: true }" class="group cursor-pointer">
            <button
                @click="open = ! open"
                class="flex w-full select-none items-center justify-between px-5 py-5 text-left font-medium hover:text-lime-600"
            >
                <span class="flex">
                    {{ $filterGroupName }}
                    @svg('heroicon-m-information-circle', 'ml-1 h-5 w-5 text-lime-700')
                </span>
                @svg('heroicon-c-chevron-up', 'h-5 w-5 duration-200 ease-out', [':class' => "{ 'rotate-180': open }"])
            </button>
            <div x-show="open" x-collapse x-cloak>
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
            </div>
        </div>
    @endforeach
</div>
