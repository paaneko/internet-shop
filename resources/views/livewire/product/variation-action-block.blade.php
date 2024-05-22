<div>
    <div class="h-18 flex items-center space-x-5 border border-b-0 bg-orange-600 bg-opacity-10 p-4">
        <div class="rounded-none bg-orange-600 px-3 py-1.5 text-sm font-semibold uppercase leading-none text-white">
            SALE!
        </div>
        <div>
            <div class="font-medium">Hurry up to buy gifts. Discounts of up to 45%</div>
            <div class="flex items-end space-x-2 leading-none">
                <span class="text-sm leading-none">Ends in:</span>
                <div class="grid auto-cols-max grid-flow-col gap-1 text-center">
                    <div class="flex flex-col rounded-sm bg-neutral p-0.5 text-neutral-content">
                        <div class="font-mono countdown text-sm">
                            <span style="--value: 15"></span>
                        </div>
                    </div>
                    <span>:</span>
                    <div class="flex flex-col rounded-sm bg-neutral p-0.5 text-neutral-content">
                        <div class="font-mono countdown text-sm">
                            <span style="--value: 10"></span>
                        </div>
                    </div>
                    <span>:</span>
                    <div class="flex flex-col rounded-sm bg-neutral p-0.5 text-neutral-content">
                        <div class="font-mono countdown text-sm">
                            <span style="--value: 24"></span>
                        </div>
                    </div>
                    <span>:</span>
                    <div class="flex flex-col rounded-sm bg-neutral p-0.5 text-neutral-content">
                        <div class="font-mono countdown text-sm">
                            <span style="--value: 30"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex">
        <div class="flex h-[350px] w-[650px] flex-col justify-between border border-r-0 p-6">
            <div class="relative">
                @svg('heroicon-o-chevron-left', 'absolute left-0 top-1 h-8 w-8 cursor-pointer fill-gray-500')
                @svg('heroicon-o-chevron-right', 'absolute right-0 top-1 h-8 w-8 cursor-pointer fill-gray-500')
                <ul class="flex items-center justify-center space-x-2">
                    @foreach ($variation->product->variations->pluck('slug', 'color') as $colorCode => $variationSlug)
                        <li
                            class="@if($variation->slug === $variationSlug) border-black @else hover:border-gray-400 @endif inline-block cursor-pointer rounded-lg border-2"
                        >
                            <a href="/{{ $variationSlug }}">
                                <div
                                    style="background-color: {{ $colorCode }}"
                                    class="m-1 block h-8 w-8 rounded"
                                ></div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="grid grid-cols-2 grid-rows-3 gap-5">
                @foreach ($variation->variationCharacteristics->take(4) as $characteristic)
                    <div>
                        <div class="text-xs opacity-80">{{ $characteristic->characteristic->name }}</div>
                        <div class="flex flex-col">
                            @foreach ($characteristic->variationAttributes as $attribute)
                                <span class="font-medium">{{ $attribute->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-4 flex justify-center text-center text-sm">
                <span class="link hover:text-green-600">See more characteristics</span>
            </div>
        </div>
        <div class="flex flex-auto flex-col border p-6">
            <div class="mb-4 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    @if ($variation->old_price == 0)
                        <div class="text-3xl font-medium leading-none">${{ $variation->price }}</div>
                    @else
                        <div class="text-3xl leading-none text-red-500">${{ $variation->old_price }}</div>
                        <div>
                            <div class="text-xs font-semibold leading-none text-red-700">
                                SAVE ${{ $variation->price - $variation->old_price }}
                            </div>
                            <div class="text-xs font-medium text-gray-500 line-through">${{ $variation->price }}</div>
                        </div>
                    @endif
                </div>

                <div class="rounded-none bg-green-200 px-4 py-2 font-semibold uppercase leading-none text-lime-700">
                    In Stock
                </div>
            </div>
            @if ($isInCart)
                <div
                    x-on:click="$dispatch('open-cart-modal')"
                    class="cursor-pointer rounded-md border-2 border-lime-500 bg-white p-4 text-center text-xl font-medium uppercase text-lime-500 hover:bg-lime-500 hover:text-white"
                >
                    Checkout
                </div>
            @else
                <div
                    wire:click="addToCart"
                    class="cursor-pointer rounded-md bg-lime-500 p-4 text-center text-xl font-medium uppercase text-white hover:bg-lime-600"
                >
                    Add To Cart
                </div>
            @endif
            <div class="flex items-center justify-center space-x-2">
                <span class="text-sm font-bold text-[#169BD7]">Buy with</span>
                @svg('fontisto-paypal', 'h-8 w-8 text-[#222D65]')
            </div>
            <div class="flex flex-auto items-end">
                <div class="flex flex-grow cursor-pointer justify-between">
                    <div
                        wire:click="addToWishlist"
                        class="{{ $isInWishlist ? 'text-lime-500 hover:text-lime-600' : 'hover:text-lime-600' }} flex items-center space-x-1.5 text-sm font-medium"
                    >
                        @svg('heroicon-s-heart', 'h-5 w-5')
                        @if ($isInWishlist)
                            <span>Saved</span>
                        @else
                            <span>Save</span>
                        @endif
                    </div>
                    <div
                        wire:click="addToCompare"
                        class="{{ $isInCompare ? 'text-lime-500 hover:text-lime-600' : 'hover:text-lime-600' }} flex cursor-pointer items-center space-x-1.5 text-sm font-medium"
                    >
                        @svg('heroicon-s-scale', 'h-5 w-5')
                        @if ($isInCompare)
                            <span>Compared</span>
                        @else
                            <span>Compare</span>
                        @endif
                    </div>
                    <div class="flex cursor-pointer items-center space-x-1.5 text-sm font-medium hover:text-lime-600">
                        @svg('heroicon-s-share', 'h-5 w-5')
                        <span>Share</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
