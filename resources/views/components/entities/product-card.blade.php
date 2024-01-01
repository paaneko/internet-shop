@props(['productItem'])

<div {{$attributes->merge(['class' => 'p-4 w-auto border rounded-none'])}}>
    <div class="flex justify-between items-center mb-2">
        <div
            class="text-xs font-medium text-white px-1.5 rounded-none pt-1 pb-1 leading-none bg-orange-600">
            New
        </div>
        <div class="text-sm font-bold">
            <span class="font-normal opacity-80">Code: </span>{{$productItem->product_code}}
        </div>
    </div>
    <figure class="flex justify-center">
        <img class="mb-4"
             src="https://duda.com.ua/image/cache/catalog/image/cache/catalog/products_photo/21006/bong-v-keyse-bitch-bong-auu-228x228.webp"
             alt="Shoes" />
    </figure>
    <div class="p-0">
        <div class="h-6 flex items-center space-x-1 mb-2">
            @svg('heroicon-s-banknotes', 'w-6 h-6 text-violet-800')
            <span class="text-sm">+333 bonuses</span>
        </div>
        <div class="h-12 mb-2">
            <a class="link font-medium leading-0 line-clamp-2 transition-all ease-in-out duration-150 hover:text-lime-600"
               href=/p/{{$productItem->slug}}
            >{{$productItem->name}}</a>
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
                <div
                    class="bg-gray-100 rounded-full p-2 cursor-pointer
                     transition-all ease-in-out duration-150 hover:bg-gray-200"
                >
                    @svg('heroicon-s-scale', 'h-5 w-5')
                </div>
                <div
                    class="bg-gray-100 rounded-full p-2 cursor-pointer
                     transition-all ease-in-out duration-150 hover:bg-gray-200"
                >
                    @svg('heroicon-s-heart', 'h-5 w-5')
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
