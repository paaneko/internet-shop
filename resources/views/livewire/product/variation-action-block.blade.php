@php
    $variationAttributes = $variation->variationCharacteristics->flatMap(function ($characteristic) {
        return $characteristic->variationAttributes->pluck('name');
    });
@endphp

<div class="flex justify-between space-x-5">
    <div class="flex flex-auto flex-grow rounded-md border border-neutral-400/70 bg-white">
        <div class="flex flex-row space-x-5 p-5">
            <div class="">
                <h1 class="text-2xl font-semibold leading-tight tracking-tight">
                    {{ $variation->name }}
                    {{ $variationAttributes->take(6)->implode(', ') }}
                </h1>
                <div class="my-2 flex justify-between">
                    <x-shared.ui.rating-count />
                    <span class="rounded bg-green-100 px-2.5 py-1 text-sm font-medium text-green-800">IN STOCK</span>
                </div>
                <div class="my-1 border-y border-neutral-200/70 py-2">
                    <x-entities.variation.related-variations :$variation :$relatedVariations />
                </div>
                <div class="my-2 text-xl font-medium text-black">Features:</div>
                <ul class="list-outside list-disc space-y-1 rounded-md bg-lime-200/70 p-2 pt-2 text-gray-600">
                    @foreach ([[], [], [], [], []] as $___)
                        <li class="ml-3.5 text-sm">{{ fake()->text() }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="space-y-2">
        <div class="flex min-h-[400px] min-w-[280px] flex-col rounded-md border border-neutral-400/70 bg-white p-5">
            <div class="mb-3 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    @if ($variation->old_price == 0)
                        <div class="text-5xl font-medium leading-none">${{ $variation->price }}</div>
                    @else
                        <div class="text-5xl font-medium leading-none tracking-tight text-red-500">
                            ${{ $variation->old_price }}
                        </div>
                        <div>
                            <div class="text-lg font-semibold leading-none tracking-tight text-red-700">
                                SAVE ${{ $variation->price - $variation->old_price }}
                            </div>
                            <div class="text-lg font-medium tracking-tight text-gray-500 line-through">
                                ${{ $variation->price }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="h-[1px] w-full bg-neutral-200/70"></div>
            <div class="my-1 mt-2 flex items-center space-x-1 text-sm text-gray-600">
                @svg('heroicon-c-arrow-path-rounded-square', 'h-5 w-5')
                <p>
                    Free
                    <span class="font-medium text-black">30 days</span>
                    Returns
                </p>
                @svg('heroicon-m-information-circle', 'h-5 w-5 text-lime-700')
            </div>
            <div class="my-1 flex items-center space-x-1 text-[13px] text-gray-600">
                @svg('gmdi-local-shipping-r', 'h-5 w-5 text-red-600')
                <p>Delivery time 1-2 business days</p>
            </div>
            <div class="mb-4 mt-1 h-[1px] w-full bg-neutral-200/70"></div>
            @if ($isInCart)
                <x-shared.ui.button
                    wire:click="$dispatch('toggle-cart-modal')"
                    type="filled"
                    class="border-2 border-lime-500 py-4 text-lime-500 hover:bg-lime-500 hover:text-white"
                >
                    <p class="text-2xl uppercase">Checkout</p>
                </x-shared.ui.button>
            @else
                <x-shared.ui.button
                    x-on:click="
                    $wire.dispatch('add-item-to-cart', { id: {{ $variation->id }} })
                    $wire.$refresh()
                    $dispatch('toggle-cart-modal')
                    "
                    type="filled"
                    class="border-2 border-lime-500 bg-lime-500 py-4 text-white hover:bg-lime-600"
                >
                    <p class="text-2xl uppercase">Add To Cart</p>
                </x-shared.ui.button>
            @endif
            <div class="my-2 flex justify-center">
                <div class="flex items-center space-x-1 rounded-md border-2 border-violet-700 px-2 text-violet-700">
                    <span class="text-[10px]">Powered by</span>
                    <span class="text-sm font-semibold">Stripe</span>
                </div>
            </div>
            <div class="h-[1px] w-full bg-neutral-200/70"></div>
            <div class="mt-2 flex justify-center font-medium text-lime-700">
                <span class="mr-1.5 italic">Ships from</span>
                <span class="font-semibold text-black">United States</span>
            </div>
            <div class="flex flex-auto items-end justify-center">
                <div class="flex cursor-pointer space-x-2">
                    <div
                        wire:click="addToWishlist"
                        class="flex items-center justify-center rounded-lg bg-lime-500 p-2 hover:bg-lime-600"
                    >
                        @if ($isInWishlist)
                            @svg('heroicon-s-heart', 'h-6 w-6 text-white')
                        @else
                            @svg('heroicon-s-heart', 'h-6 w-6 text-lime-800')
                        @endif
                    </div>
                    <div
                        wire:click="addToCompare"
                        class="flex items-center justify-center rounded-lg bg-lime-500 p-2 hover:bg-lime-600"
                    >
                        @if ($isInCompare)
                            @svg('heroicon-s-scale', 'h-6 w-6 text-white')
                        @else
                            @svg('heroicon-s-scale', 'h-6 w-6 text-lime-800')
                        @endif
                    </div>
                    <div class="flex items-center justify-center rounded-lg bg-lime-500 p-2 hover:bg-lime-600">
                        @svg('heroicon-s-share', 'h-6 w-6 text-white')
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center space-x-2 rounded-md border-2 border-lime-600 bg-white p-5">
            @svg('heroicon-s-globe-americas', 'h-10 w-10 text-lime-600')
            <span class="text-xl font-semibold text-lime-600">Free Shipping</span>
        </div>
        <div class="flex items-center space-x-2 rounded-md border-2 border-lime-600 bg-white p-5">
            @svg('heroicon-s-receipt-refund', 'h-10 w-10 text-lime-600')
            <span class="text-xl font-semibold text-lime-600">Easy Returns</span>
        </div>
        <div class="flex items-center space-x-2 rounded-md border-2 border-lime-600 bg-white p-5">
            @svg('heroicon-m-shield-check', 'h-10 w-10 text-lime-600')
            <span class="text-xl font-semibold text-lime-600">Secure Checkout</span>
        </div>
    </div>
</div>
