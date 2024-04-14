@php
    $wishListSession = collect(session()->get('wishlist', []));
    $compareProductsSession = collect(session()->get('compare', []));

    $inWishlist = $wishListSession->contains($variation->id);
    $inCompareProducts = $compareProductsSession->contains($variation->id);
@endphp

<div class='p-4 w-auto border rounded-none'>
    <div class="flex justify-between items-center mb-2">
        <div
            class="text-xs font-medium text-white px-1.5 rounded-none pt-1 pb-1 leading-none bg-orange-600">
            New
        </div>
        <div class="text-sm font-bold">
            <span class="font-normal opacity-80">Code: </span>{{$variation->product_code}}
        </div>
    </div>
    <figure class="flex justify-center">
        @if(! $variation->getFirstMedia())
            @svg('gmdi-hide-image-tt', 'mb-4 w-[228px] h-[228px] text-lime-600')
        @else
            <img class="mb-2 w-[228px] h-[228px]"
                 src="{{ $variation->getFirstMedia()?->getUrl('thumb') }}"
                 alt="" />
        @endif
    </figure>
    <div class="p-0">
        <ul class="flex items-center justify-center space-x-1 mb-2">
            @foreach($variation->product->variations->pluck("slug", "color") as $colorCode => $variationSlug)
                <li class="inline-block border-2 rounded-lg @if($variation->slug === $variationSlug) border-black @else hover:border-gray-400 @endif cursor-pointer">
                    <a href="/{{ $variationSlug }}">
                        <div style="background-color: {{$colorCode}};" class="block w-6 h-6 m-0.5 rounded"></div>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="h-12 mb-2">
            <a class="link font-medium leading-0 line-clamp-2 transition-all ease-in-out duration-150 hover:text-lime-600"
               href={{asset($variation->slug)}}
            >{{$variation->name}}</a>
        </div>
        <div class="flex items-center space-x-3 mb-4">
            <div class="h-5 flex items-center space-x-1">
                @svg('heroicon-o-star', 'w-4 h-4 text-amber-500 fill-amber-500')
                <span class="text-xs font-semibold">4.8</span>
            </div>
            <div
                class="text-xs font-semibold px-1.5 rounded-none pt-1 pb-1 leading-none text-lime-600 bg-[#F5F8E7]">
                In Stock
            </div>
        </div>
        <div class="flex items-center space-x-2 mb-4 ">
            @svg('heroicon-s-truck', 'w-5 h-5 text-red-600')
            <span class="text-xs opacity-80">SHIPS IN 5-7 BUSINESS DAYS</span>
        </div>
        <div class="flex justify-between items-center">
            <div class="leading-none font-medium">
                <div class="text-xs text-gray-500 line-through">$600</div>
                <div class="text-red-500 text-lg leading-none">$550</div>
            </div>
            <div class="flex space-x-2">
                <div wire:click="addToCompareProducts"
                     class="rounded-full p-2 cursor-pointer
                     transition-all ease-in-out duration-150
                     {{ $inCompareProducts ? "bg-lime-500 hover:bg-lime-600" : "bg-gray-100 hover:bg-gray-200" }}"
                >
                    @if($inCompareProducts)
                        @svg('heroicon-s-scale', 'h-5 w-5 text-white')
                    @else
                        @svg('heroicon-s-scale', 'h-5 w-5')
                    @endif
                </div>
                <div wire:click="addToWishlist"
                     class="rounded-full p-2 cursor-pointer
                     transition-all ease-in-out duration-150
                     {{ $inWishlist ? "bg-lime-500 hover:bg-lime-600" : "bg-gray-100 hover:bg-gray-200" }}"
                >
                    @if($inWishlist)
                        @svg('heroicon-s-heart', 'h-5 w-5 text-white')
                    @else
                        @svg('heroicon-s-heart', 'h-5 w-5')
                    @endif
                </div>
                <div
                    class="bg-lime-600 rounded-full p-2 cursor-pointer
                     transition-all ease-in-out duration-150 hover:bg-lime-700"
                >
                    @svg('heroicon-s-shopping-bag', 'h-5 w-5 text-white')
                </div>
            </div>
        </div>
    </div>
</div>
