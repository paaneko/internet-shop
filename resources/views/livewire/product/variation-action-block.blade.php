<div>
    <div
        class="flex items-center p-4 border border-b-0 h-18 bg-orange-600 bg-opacity-10 space-x-5">
        <div
            class="text-sm font-semibold uppercase px-3 rounded-none py-1.5 leading-none text-white bg-orange-600">
            SALE!
        </div>
        <div>
            <div class="font-medium">Hurry up to buy gifts. Discounts of up to 45%</div>
            <div class="flex space-x-2 items-end leading-none">
                <span class="text-sm leading-none">Ends in:</span>
                <div class="grid grid-flow-col gap-1 text-center auto-cols-max">
                    <div
                        class="flex flex-col p-0.5 bg-neutral rounded-sm text-neutral-content">
                        <div class="countdown font-mono text-sm">
                            <span style="--value:15;"></span>
                        </div>
                    </div>
                    <span>:</span>
                    <div class="flex flex-col p-0.5 bg-neutral rounded-sm text-neutral-content">
                        <div class="countdown font-mono text-sm">
                            <span style="--value:10;"></span>
                        </div>
                    </div>
                    <span>:</span>
                    <div class="flex flex-col p-0.5 bg-neutral rounded-sm text-neutral-content">
                        <div class="countdown font-mono text-sm">
                            <span style="--value:24;"></span>
                        </div>
                    </div>
                    <span>:</span>
                    <div class="flex flex-col p-0.5 bg-neutral rounded-sm text-neutral-content">
                        <div class="countdown font-mono text-sm">
                            <span style="--value:30;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex">
        <div class="p-6 flex flex-col justify-between w-[650px] h-[350px] border border-r-0">
            <div class="relative">
                @svg('heroicon-o-chevron-left', 'absolute w-8 h-8 top-1 left-0 fill-gray-500 cursor-pointer')
                @svg('heroicon-o-chevron-right', 'absolute w-8 h-8 top-1 right-0 fill-gray-500 cursor-pointer')
                <ul class="flex items-center justify-center space-x-2">
                    @foreach($variation->product->variations->pluck("slug", "color") as $colorCode => $variationSlug)
                        <li class="inline-block border-2 rounded-lg @if($variation->slug === $variationSlug) border-black @else hover:border-gray-400 @endif cursor-pointer">
                            <a href="/{{ $variationSlug }}">
                                <div style="background-color: {{$colorCode}};" class="block w-8 h-8 m-1 rounded"></div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="grid grid-cols-2 grid-rows-3 gap-5">
                @foreach($variation->variationCharacteristics->take(4) as $characteristic)
                    <div>
                        <div class="text-xs opacity-80">{{ $characteristic->characteristic->name }}</div>
                        <div class="flex flex-col">
                            @foreach($characteristic->variationAttributes as $attribute)
                                <span class="font-medium">{{ $attribute->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center text-center text-sm mb-4">
                <span class="link hover:text-green-600">See more characteristics</span>
            </div>
        </div>
        <div class="p-6 flex flex-col flex-auto border">
            <div class="mb-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    @if($variation->old_price == 0)
                        <div class="text-3xl font-medium leading-none">${{ $variation->price }}</div>
                    @else
                        <div class="text-red-500 text-3xl leading-none">${{ $variation->old_price }}</div>
                        <div>
                            <div class="text-xs font-semibold text-red-700 leading-none">SAVE
                                ${{$variation->price - $variation->old_price}}</div>
                            <div class="text-xs font-medium text-gray-500 line-through">${{ $variation->price }}</div>
                        </div>
                    @endif
                </div>

                <div
                    class="font-semibold uppercase px-4 rounded-none py-2 leading-none text-lime-700 bg-green-200">
                    In Stock
                </div>
            </div>
            @if($isInCart)
                <div
                    x-on:click="$dispatch('open-cart-modal')"
                    class="p-4 text-center font-medium text-xl text-lime-500 uppercase bg-white rounded-md hover:text-white border-2 border-lime-500 hover:bg-lime-500 cursor-pointer">
                    Checkout
                </div>
            @else
                <div
                    wire:click="addToCart"
                    class="p-4 text-center font-medium text-xl text-white uppercase bg-lime-500 rounded-md hover:bg-lime-600 cursor-pointer">
                    Add To Cart
                </div>
            @endif
            <div class="flex justify-center items-center space-x-2">
                <span class="text-sm font-bold text-[#169BD7]">Buy with</span>
                @svg('fontisto-paypal', 'w-8 h-8 text-[#222D65]')
            </div>
            <div class="flex flex-auto items-end">
                <div class="flex justify-between flex-grow cursor-pointer ">
                    <div
                        wire:click="addToWishlist"
                        class="flex text-sm font-medium items-center space-x-1.5
                        {{ $isInWishlist ? "text-lime-500 hover:text-lime-600" : "hover:text-lime-600" }}">
                        @svg('heroicon-s-heart', 'h-5 w-5')
                        @if($isInWishlist)
                            <span>Saved</span>
                        @else
                            <span>Save</span>
                        @endif
                    </div>
                    <div
                        wire:click="addToCompare"
                        class="flex text-sm font-medium items-center space-x-1.5 cursor-pointer
                        {{ $isInCompare ? "text-lime-500 hover:text-lime-600" : "hover:text-lime-600" }}">
                        @svg('heroicon-s-scale', 'h-5 w-5')
                        @if($isInCompare)
                            <span>Compared</span>
                        @else
                            <span>Compare</span>
                        @endif
                    </div>
                    <div
                        class="flex text-sm font-medium items-center space-x-1.5 cursor-pointer hover:text-lime-600">
                        @svg('heroicon-s-share', 'h-5 w-5')
                        <span>Share</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
