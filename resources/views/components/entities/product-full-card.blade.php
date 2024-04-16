@props(['variation'])

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
    <div class="p-6 flex flex-col justify-between w-[600px] h-[350px] border border-r-0">
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
        <div class="relative">
            @svg('heroicon-o-chevron-left', 'absolute w-8 h-8 top-1 left-0 fill-gray-500 cursor-pointer')
            @svg('heroicon-o-chevron-right', 'absolute w-8 h-8 top-1 right-0 fill-gray-500 cursor-pointer')
            <ul class="flex items-center justify-center space-x-2">
                <li class="border-inherit inline-block border-2 rounded-lg border-black hover:border-black cursor-pointer">
                    <div class="bg-red-600 block w-8 h-8 m-1 rounded"></div>
                </li>
                <li class="border-inherit inline-block border-2 rounded-lg border-gray-300 hover:border-black cursor-pointer">
                    <div class="bg-green-600 block w-8 h-8 m-1 rounded"></div>
                </li>
                <li class="border-inherit inline-block border-2 rounded-lg border-gray-300 hover:border-black cursor-pointer">
                    <div class="bg-blue-600 block w-8 h-8 m-1 rounded"></div>
                </li>
                <li class="border-inherit inline-block border-2 rounded-lg border-gray-300 hover:border-black cursor-pointer">
                    <div class="bg-yellow-600 block w-8 h-8 m-1 rounded"></div>
                </li>
                <li class="border-inherit inline-block border-2 rounded-lg border-gray-300 hover:border-black cursor-pointer">
                    <div class="bg-fuchsia-500 block w-8 h-8 m-1 rounded"></div>
                </li>
                <li class="border-inherit inline-block border-2 rounded-lg border-gray-300 hover:border-black cursor-pointer">
                    <div class="bg-black block w-8 h-8 m-1 rounded"></div>
                </li>
                <li class="border-inherit inline-block border-2 rounded-lg border-gray-300 hover:border-black cursor-pointer">
                    <div class="bg-white block w-8 h-8 m-1 rounded"></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="p-6 flex flex-col flex-auto border">
        <div class="mb-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                @if($variation->old_price === 0)
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
        <div
            class="btn btn-lg mb-1 w-full text-xl text-white uppercase bg-lime-500 rounded-none hover:bg-lime-700">
            @svg('gmdi-shopping-cart', 'h-8 w-8')
            Add To Cart
        </div>
        <div class="flex justify-center items-center space-x-2">
            <span class="text-sm font-bold text-[#169BD7]">Buy with</span>
            @svg('fontisto-paypal', 'w-8 h-8 text-[#222D65]')
        </div>
        <div class="flex flex-auto items-end">
            <div class="flex justify-between flex-grow cursor-pointer ">
                <div class="flex text-sm font-medium items-center space-x-1.5 hover:text-lime-600">
                    @svg('heroicon-s-heart', 'h-5 w-5')
                    <span>Save</span>
                </div>
                <div
                    class="flex text-sm font-medium items-center space-x-1.5 cursor-pointer hover:text-lime-600">
                    @svg('heroicon-s-scale', 'h-5 w-5')
                    <span>Compare</span>
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
