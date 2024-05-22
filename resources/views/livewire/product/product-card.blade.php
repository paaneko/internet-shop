<div class="w-auto rounded-none border p-4">
    <div class="mb-2 flex items-center justify-between">
        <div class="rounded-none bg-orange-600 px-1.5 pb-1 pt-1 text-xs font-medium leading-none text-white">New</div>
        <div class="text-sm font-bold">
            <span class="font-normal opacity-80">Code:</span>
            {{ $variation->product_code }}
        </div>
    </div>
    <figure class="flex justify-center">
        @if (! $variation->getFirstMedia())
            @svg('gmdi-hide-image-tt', 'mb-4 h-[228px] w-[228px] text-lime-600')
        @else
            <img class="mb-2 h-[228px] w-[228px]" src="{{ $variation->getFirstMedia()?->getUrl('thumb') }}" alt="" />
        @endif
    </figure>
    <div class="p-0">
        <ul class="mb-2 flex items-center justify-center space-x-1">
            @foreach ($variation->product->variations->pluck('slug', 'color') as $colorCode => $variationSlug)
                <li
                    class="@if($variation->slug === $variationSlug) border-black @else hover:border-gray-400 @endif inline-block cursor-pointer rounded-lg border-2"
                >
                    <a href="/{{ $variationSlug }}">
                        <div style="background-color: {{ $colorCode }}" class="m-0.5 block h-6 w-6 rounded"></div>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="mb-2 h-12">
            <a
                class="leading-0 link line-clamp-2 font-medium transition-all duration-150 ease-in-out hover:text-lime-600"
                href="{{ asset($variation->slug) }}"
            >
                {{ $variation->name }}
            </a>
        </div>
        <div class="mb-4 flex items-center space-x-3">
            <div class="flex h-5 items-center space-x-1">
                @svg('heroicon-o-star', 'h-4 w-4 fill-amber-500 text-amber-500')
                <span class="text-xs font-semibold">4.8</span>
            </div>
            <div class="rounded-none bg-[#F5F8E7] px-1.5 pb-1 pt-1 text-xs font-semibold leading-none text-lime-600">
                In Stock
            </div>
        </div>
        <div class="mb-4 flex items-center space-x-2">
            @svg('heroicon-s-truck', 'h-5 w-5 text-red-600')
            <span class="text-xs opacity-80">SHIPS IN 5-7 BUSINESS DAYS</span>
        </div>
        <div class="flex items-center justify-between">
            <div class="font-medium leading-none">
                @if ($variation->old_price == 0)
                    <div class="text-lg">${{ $variation->price }}</div>
                @else
                    <div class="text-xs text-gray-500 line-through">${{ $variation->price }}</div>
                    <div class="text-lg leading-none text-red-500">${{ $variation->old_price }}</div>
                @endif
            </div>
            <div class="flex space-x-2">
                <div
                    wire:click="addToCompareProducts"
                    class="{{ $isInCompare ? 'bg-lime-500 hover:bg-lime-600' : 'bg-gray-100 hover:bg-gray-200' }} cursor-pointer rounded-full border border-transparent p-2 transition-all duration-150 ease-in-out"
                >
                    @if ($isInCompare)
                        @svg('heroicon-s-scale', 'h-5 w-5 text-white')
                    @else
                        @svg('heroicon-s-scale', 'h-5 w-5')
                    @endif
                </div>
                <div
                    wire:click="addToWishlist"
                    class="{{ $isInWishlist ? 'bg-lime-500 hover:bg-lime-600' : 'bg-gray-100 hover:bg-gray-200' }} cursor-pointer rounded-full border border-transparent p-2 transition-all duration-150 ease-in-out"
                >
                    @if ($isInWishlist)
                        @svg('heroicon-s-heart', 'h-5 w-5 text-white')
                    @else
                        @svg('heroicon-s-heart', 'h-5 w-5')
                    @endif
                </div>
                @if ($isInCart)
                    <div
                        x-on:click="$dispatch('open-cart-modal')"
                        class="cursor-pointer rounded-full border border-lime-500 p-2 text-lime-500 transition-all duration-150 ease-in-out hover:bg-lime-500 hover:text-white"
                    >
                        @svg('heroicon-s-check-circle', 'h-5 w-5')
                    </div>
                @else
                    <div
                        wire:click="addToCart"
                        class="cursor-pointer rounded-full bg-lime-500 p-2 transition-all duration-150 ease-in-out hover:bg-lime-600"
                    >
                        @svg('heroicon-s-shopping-bag', 'h-5 w-5 text-white')
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
